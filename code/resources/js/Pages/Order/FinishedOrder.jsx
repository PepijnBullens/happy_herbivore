import styles from "../../../css/finishedOrder.module.scss";
import LanguageDisplayer from "@/Components/LanguageDisplayer";
import PrimaryButton from "@/Components/PrimaryButton";
import FinishingOrderLayout from "../../Layouts/FinishingOrderLayout";
import { useEffect } from "react";
import { router } from "@inertiajs/react";
import "../../../css/kioskApp.scss";

export default function FinishedOrder({ language, pickupNumber, success }) {
    useEffect(() => {
        setTimeout(() => {
            router.visit("/");
        }, 10000);
    }, []);

    return (
        <FinishingOrderLayout
            footer={
                <PrimaryButton onClick={() => router.visit("/")}>
                    <LanguageDisplayer
                        language={language}
                        words={{
                            dutch: "voltooien",
                            english: "Finish",
                            german: "Fertig",
                        }}
                    />
                </PrimaryButton>
            }
        >
            <div className={styles.container}>
                {success ? (
                    <>
                        <h2 className={styles.pickup__text}>
                            <LanguageDisplayer
                                language={language}
                                words={{
                                    english:
                                        "Thank you for ordering at Happy Herbivore!",
                                    dutch: "Bedankt voor het bestellen bij Happy Herbivore!",
                                    german: "Danke für die Bestellung bei Happy Herbivore!",
                                }}
                            />
                            <br />
                            <br />
                            <span>
                                <LanguageDisplayer
                                    language={language}
                                    words={{
                                        english: "Your pick-up number is:",
                                        dutch: "Uw afhaalnummer is:",
                                        german: "Ihre Abholnummer ist:",
                                    }}
                                />
                            </span>
                        </h2>
                        <h2 className={styles.pickup__number}>
                            #{pickupNumber.toString().padStart(2, "0")}
                        </h2>
                    </>
                ) : (
                    <div className={styles.pickup__text}>
                        <LanguageDisplayer
                            language={language}
                            words={{
                                english: "Something went wrong!",
                                dutch: "Er is iets misgegaan!",
                                german: "Etwas ist schief gelaufen!",
                            }}
                        />
                    </div>
                )}
            </div>
        </FinishingOrderLayout>
    );
}
