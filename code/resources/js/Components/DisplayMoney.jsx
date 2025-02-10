export default function DisplayMoney({ amount }) {
    return (
        "€" +
        amount.toLocaleString(undefined, {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2,
        })
    );
}
