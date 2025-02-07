import styles from "../../css/Components/languageSelector.module.scss";

export default function LanguageSelector({ setLanguage }) {
    return (
        <div className={styles.language__selector}>
            <button onClick={() => setLanguage("dutch")}>
                <img src="/assets/flags/nl.svg" alt="Flag of the Netherlands" />
            </button>
            <button onClick={() => setLanguage("english")}>
                <img
                    src="/assets/flags/gb.svg"
                    alt="Flag of the United Kingdom"
                />
            </button>
            <button onClick={() => setLanguage("german")}>
                <img src="/assets/flags/de.svg" alt="Flag of Germany" />
            </button>
        </div>
    );
}
