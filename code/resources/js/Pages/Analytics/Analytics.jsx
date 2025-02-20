import "../../../css/fullscreenApp.scss";
import styles from "../../../css/analytics.module.scss";
import React from "react";
import ReactApexChart from "react-apexcharts";

export default function Analytics({ orderData }) {
    const orderDataArray = Object.entries(orderData);
    console.log(orderDataArray);

    const [state] = React.useState({
        seriesTotalRevenue: [
            {
                name: "price",
                colors: ["white", "white"],
                data: orderDataArray.map((order) => {
                    const price = order[1].totalRevenue;
                    return isNaN(price) ? 0 : price;
                }),
            },
        ],
        optionsTotalRevenue: {
            chart: {
                height: 500,
                width: 400,
                type: "bar",
                zoom: {
                    enabled: false,
                },
            },
            title: {
                text: "Total Revenue",
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
            plotOptions: {
                bar: {
                    borderRadius: 4,
                    borderRadiusApplication: "end",
                    horizontal: true,
                },
            },
            dataLabels: {
                enabled: false,
            },
            xaxis: {
                categories: orderDataArray.map((order) => {
                    const date = new Date(order[0]);
                    return `${date.getDate()} ${date.toLocaleString("default", {
                        month: "short",
                    })}`;
                }),
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
        seriesAverageOrderPrice: [
            {
                name: "price",
                colors: ["white", "white"],
                data: orderDataArray.map((order) => {
                    const price = order[1].averageOrderPrice;
                    return isNaN(price) ? 0 : price;
                }),
            },
        ],
        optionsAverageOrderPrice: {
            chart: {
                height: 500,
                width: 400,
                type: "basic-bar",
                zoom: {
                    enabled: false,
                },
            },
            title: {
                text: "Average Order Price",
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
                categories: orderDataArray.map((order) => {
                    const date = new Date(order[0]);
                    return `${date.getDate()} ${date.toLocaleString("default", {
                        month: "short",
                    })}`;
                }),
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
        seriesTotalOrders: [
            {
                name: "quantity",
                colors: ["white", "white"],
                data: orderDataArray.map((order) => {
                    const quantity = order[1].totalOrders;
                    return isNaN(quantity) ? 0 : quantity;
                }),
            },
        ],
        optionsTotalOrders: {
            chart: {
                height: 500,
                width: 400,
                type: "basic-bar",
                zoom: {
                    enabled: false,
                },
            },
            title: {
                text: "Total Orders",
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
                categories: orderDataArray.map((order) => {
                    const date = new Date(order[0]);
                    return `${date.getDate()} ${date.toLocaleString("default", {
                        month: "short",
                    })}`;
                }),
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
                        return value;
                    },
                },
            },
        },

        seriesMostPopularProduct: [
            {
                name: "sales",
                data: orderDataArray.map((order) => {
                    return {
                        x:
                            order[1].mostPopularProduct &&
                            order[1].mostPopularProduct.name_english
                                ? order[1].mostPopularProduct.name_english
                                : "No Product",
                        y: order[1].mostPopularProduct
                            ? order[1].mostPopularProduct.total_quantity
                            : 0,
                    };
                }),
            },
        ],
        optionsMostPopularProduct: {
            chart: {
                height: 500,
                width: 400,
                type: "basic-bar",
                zoom: {
                    enabled: false,
                },
            },
            title: {
                text: "Most Popular Product",
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
                categories: orderDataArray.map((order) => {
                    const date = new Date(order[0]);
                    return `${date.getDate()} ${date.toLocaleString("default", {
                        month: "short",
                    })}`;
                }),
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
                        return value;
                    },
                },
            },
            dataLabels: {
                enabled: true,
                formatter: function (val, opts) {
                    return opts.w.config.series[opts.seriesIndex].data[
                        opts.dataPointIndex
                    ].x;
                },
                style: {
                    colors: ["white"],
                },
            },
        },

        seriesMostPopularProduct: [
            {
                data: orderDataArray.map((order) => {
                    return order[1].mostPopularProduct
                        ? order[1].mostPopularProduct.total_quantity
                        : 0;
                }),
            },
        ],
        optionsMostPopularProduct: {
            chart: {
                type: "bar",
                height: 350,
            },
            plotOptions: {
                bar: {
                    borderRadius: 4,
                    borderRadiusApplication: "end",
                    horizontal: true,
                },
            },
            dataLabels: {
                enabled: true,
                formatter: function (val, opts) {
                    const order = orderDataArray[opts.dataPointIndex][1];
                    return order.mostPopularProduct &&
                        order.mostPopularProduct.name_english
                        ? order.mostPopularProduct.name_english
                        : "No Product";
                },
            },
            xaxis: {
                categories: orderDataArray.map((order) => {
                    const date = new Date(order[0]);
                    return `${date.getDate()} ${date.toLocaleString("default", {
                        month: "short",
                    })}`;
                }),
            },
            title: {
                text: "Most Popular Product",
                align: "center",
                style: {
                    color: "black",
                },
            },
        },
    });

    return (
        <div className={styles.chart__container}>
            <div className={styles.chart__wrapper}>
                <div className={styles.chart}>
                    <ReactApexChart
                        options={state.optionsTotalRevenue}
                        series={state.seriesTotalRevenue}
                        type="line"
                        height={200}
                    />
                    <ReactApexChart
                        options={state.optionsAverageOrderPrice}
                        series={state.seriesAverageOrderPrice}
                        type="line"
                        height={200}
                    />
                    <ReactApexChart
                        options={state.optionsTotalOrders}
                        series={state.seriesTotalOrders}
                        type="line"
                        height={200}
                    />
                    <ReactApexChart
                        options={state.optionsMostPopularProduct}
                        series={state.seriesMostPopularProduct}
                        type="bar"
                        height={600}
                    />
                </div>
            </div>
            <div className={styles.chart__wrapper}></div>
        </div>
    );
}
