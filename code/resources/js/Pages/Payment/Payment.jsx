import styles from "../../../css/payment.module.scss";
import LanguageDisplayer from "@/Components/LanguageDisplayer";
import PrimaryButton from "@/Components/PrimaryButton";
import FinishingOrderLayout from "../../Layouts/FinishingOrderLayout";

export default function Payment({ language }) {
    return (
        <FinishingOrderLayout
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
                </PrimaryButton>
            }
        >
            <img src="/assets/terminal.svg" alt="Image of payment terminal" />
        </FinishingOrderLayout>
    );
}
