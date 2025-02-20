import "../../../css/fullscreenApp.scss";
import styles from "../../../css/analytics.module.scss";
import React from "react";
import ReactApexChart from "react-apexcharts";

export default function Analytics({ orderData }) {
    const orderDataArray = Object.entries(orderData);

    const [state] = React.useState({
        series: [
            {
                name: "price",
                colors: ["white", "white"],
                data: orderDataArray.map((order) => {
                    const price = order[1].averageOrderPrice;
                    return isNaN(price) ? 0 : price;
                }),
            },
        ],
        options: {
            chart: {
                height: 500,
                width: 400,
                type: "line",
                zoom: {
                    enabled: false,
                },
            },
            dataLabels: {
                enabled: false,
            },
            stroke: {
                curve: "straight",
            },
            title: {
                text: "Product Trends by Month",
                align: "left",
                style: {
                    color: "white",
                },
            },
            grid: {
                row: {
                    colors: ["white", "white"],
                    opacity: 0.5,
                },
            },
            xaxis: {
                categories: orderDataArray.map((order) => order[0]),
                labels: {
                    style: {
                        colors: "white",
                    },
                },
            },
            yaxis: {
                labels: {
                    style: {
                        colors: "white",
                    },
                    formatter: function (value) {
                        return `$${value.toFixed(2)}`;
                    },
                },
            },
        },
    });

    return (
        <>
            <div className={styles.chart__container}>
                <div id="chart">
                    <ReactApexChart
                        options={state.options}
                        series={state.series}
                        type="line"
                        height={400}
                    />
                </div>
                <div id="html-dist"></div>
            </div>
        </>
    );
}
