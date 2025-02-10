import styles from "../../css/Components/CompactLanguageSelector.module.scss";
import { useState } from "react";

export default function CompactLanguageSelector({ language = null }) {
    const setLanguage = (language) => {
        fetch(`/set-language/${language}`, {
            method: "GET",
        })
            .then((response) => response.json())
            .then((data) => {
                if (data.language) {
                    setCurrentlyActive(data.language);
                    window.location.reload();
                } else if (data.error) {
                    console.error(data.error);
                }
            })
            .catch((error) => {
                console.error("Error:", error);
            });
    };

    const [currentlyActive, setCurrentlyActive] = useState(language);

    return (
        <div className={styles.language__selector}>
            <div
                className={`${styles.language__selector__flag} ${
                    currentlyActive === "dutch" ? styles.active : ""
                }`}
                onClick={() => setLanguage("dutch")}
            >
                <img src="/assets/flags/nl.svg" alt="Dutch flag" />
            </div>
            <div
                className={`${styles.language__selector__flag} ${
                    currentlyActive === "english" ? styles.active : ""
                }`}
                onClick={() => setLanguage("english")}
            >
                <img src="/assets/flags/gb.svg" alt="English flag" />
            </div>
            <div
                className={`${styles.language__selector__flag} ${
                    currentlyActive === "german" ? styles.active : ""
                }`}
                onClick={() => setLanguage("german")}
            >
                <img src="/assets/flags/de.svg" alt="German flag" />
            </div>
        </div>
    );
}
