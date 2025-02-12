import React, { useEffect, useState } from "react";
import "../../../css/kioskApp.scss";

export default function Index({ initialOrders }) {
    const [orders, setOrders] = useState(initialOrders || []);
    const [connection, setConnection] = useState("Connecting...");

    useEffect(() => {
        const token = process.env.REACT_APP_WEBSOCKET_TOKEN;
        const socket = new WebSocket(`ws://localhost:6001?token=${token}`);

        socket.onopen = () => {
            setConnection("Connected");
        };

        socket.onerror = () => {
            setConnection("Unable to connect");
        };

        socket.onmessage = (event) => {
            const data = JSON.parse(event.data);
            console.log("Received from server:", data);

            setOrders((prev) => [...prev, data]);
        };

        return () => {
            socket.close();
        };
    }, []);

    return (
        <>
            {connection}

            {orders &&
                orders.map((order, index) => (
                    <div key={index}>{order.pickup_number}</div>
                ))}
        </>
    );
}
