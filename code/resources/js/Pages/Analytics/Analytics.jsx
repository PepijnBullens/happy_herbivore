import "../../../css/fullscreenApp.scss";
import styles from "../../../css/analytics.module.scss";
import React from "react";
import ReactApexChart from "react-apexcharts";

export default function Analytics({ orderData }) {
    const orderDataArray = Object.entries(orderData);
    console.log(orderDataArray);

    const [state] = React.useState({
        series: [
            {
                name: "price",
                colors: ["white", "white"],
                data: orderDataArray.map((order) => {
                    const price = order[1].totalRevenue;
                    return isNaN(price) ? 0 : price;
                }),
            },
        ],
        options: {
            chart: {
                height: 500,
                width: 400,
                type: "basic-bar",
                zoom: {
                    enabled: false,
                },
            },
            stroke: {
                curve: "curved",
            },
            title: {
                text: "Product Trends by Month",
                align: "center",
                style: {
                    color: "black",
                },
            },
            grid: {
                row: {
                    colors: ["white", "white"],
                    opacity: 0,
                },
            },
            xaxis: {
                categories: orderDataArray.map((order) => order[0]),
                labels: {
                    style: {
                        colors: "black",
                    },
                },
            },
            yaxis: {
                labels: {
                    style: {
                        colors: "black",
                    },
                    formatter: function (value) {
                        return `$${value.toFixed(2)}`;
                    },
                },
            },
        },
    });

    return (
        <div className={styles.chart__container}>
            <div className={styles.chart__wrapper}>
                <div className={styles.chart}>
                    <ReactApexChart
                        options={state.options}
                        series={state.series}
                        type="bar"
                        height={400}
                    />
                </div>
            </div>
            <div className={styles.chart__wrapper}></div>
        </div>
    );
}
