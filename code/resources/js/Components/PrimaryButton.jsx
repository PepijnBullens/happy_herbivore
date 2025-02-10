import styles from "../../css/Components/primaryButton.module.scss";

export default function PrimaryButton({ children, onClick, width = null }) {
    return (
        <button
            className={styles.primary__button}
            onClick={onClick}
            style={{ width: width ? `${width}%` : "auto" }}
        >
            {children}
        </button>
    );
}
