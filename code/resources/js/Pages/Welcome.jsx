import WelcomeLayout from "@/Layouts/WelcomeLayout";
import PrimaryButton from "@/Components/PrimaryButton";
import LanguageDisplayer from "@/Components/LanguageDisplayer";
import { ShoppingBag } from "lucide-react";
import { useState } from "react";

export default function Welcome({ images, language = null }) {
    const [overwrittenLanguage, setOverwrittenLanguage] = useState(null);

    // Define setLanguage inside Welcome so it has access to the state
    const setLanguage = (language) => {
        fetch(`/set-language/${language}`, {
            method: "GET",
        })
            .then((response) => response.json())
            .then((data) => {
                setOverwrittenLanguage(data.language);
            })
            .catch((error) => {
                console.error("Error:", error);
            });
    };

    return (
        <WelcomeLayout images={images} setLanguage={setLanguage}>
            <PrimaryButton>
                <ShoppingBag />
                <LanguageDisplayer
                    language={overwrittenLanguage ?? language}
                    overwrittenLanguage={overwrittenLanguage}
                    words={{
                        english: "Start Order",
                        dutch: "Bestelling Starten",
                        german: "Startreihenfolge",
                    }}
                />
            </PrimaryButton>
        </WelcomeLayout>
    );
}
