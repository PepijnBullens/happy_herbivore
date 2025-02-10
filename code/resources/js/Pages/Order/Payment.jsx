import styles from "../../../css/payment.module.scss";
import LanguageDisplayer from "@/Components/LanguageDisplayer";
import PrimaryButton from "@/Components/PrimaryButton";
import FinishingOrderLayout from "../../Layouts/FinishingOrderLayout";
import { useEffect } from "react";
import { router } from "@inertiajs/react";

export default function Payment({ language }) {
    useEffect(() => {
        setTimeout(() => {
            router.visit("/finished-order");
        }, 3000);
    }, []);

    return (
        <FinishingOrderLayout
            back={"/your-order"}
            footer={
                <PrimaryButton>
                    <LanguageDisplayer
                        language={language}
                        words={{
                            dutch: "verwerking",
                            english: "processing",
                            german: "Verarbeitung",
                        }}
                    />
                    <div className={styles.loader}></div>
                </PrimaryButton>
            }
        >
            <img
                className={styles.terminal}
                src="/assets/terminal.svg"
                alt="Image of payment terminal"
            />
        </FinishingOrderLayout>
    );
}
