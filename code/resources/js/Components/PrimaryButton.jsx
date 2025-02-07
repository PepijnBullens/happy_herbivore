import styles from "../../css/Components/primaryButton.module.scss";

export default function PrimaryButton({ children, onClick }) {
    return (
        <button className={styles.primary__button} onClick={onClick}>
            {children}
        </button>
    );
}
