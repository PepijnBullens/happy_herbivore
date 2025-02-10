import styles from "../../../css/payment.module.scss";
import LanguageDisplayer from "@/Components/LanguageDisplayer";
import PrimaryButton from "@/Components/PrimaryButton";

export default function Payment({ language }) {
    return (
        <div className={styles.container}>
            <header>
                <img
                    src="/assets/logo/text-logo.png"
                    alt="Happy Herbivore logo"
                />
            </header>

            <div className={styles.content}>
                <img
                    src="/assets/terminal.svg"
                    alt="Image of payment terminal"
                />
            </div>

            <footer>
                <PrimaryButton>
                    <LanguageDisplayer
                        language={language}
                        words={{
                            dutch: "verwerking",
                            english: "processing",
                            german: "Verarbeitung",
                        }}
                    />
                </PrimaryButton>
            </footer>
        </div>
    );
}
