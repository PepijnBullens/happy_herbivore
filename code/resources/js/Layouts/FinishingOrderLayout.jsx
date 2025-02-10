import styles from "../../css/Layouts/finishingOrderLayout.module.scss";

export default function FinishingOrderLayout({ children, footer }) {
    return (
        <div className={styles.container}>
            <header>
                <img
                    src="/assets/logo/text-logo.png"
                    alt="Happy Herbivore logo"
                />
            </header>

            <div className={styles.content}>{children}</div>

            <footer>{footer}</footer>
        </div>
    );
}
