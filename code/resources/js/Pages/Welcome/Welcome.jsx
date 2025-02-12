import WelcomeLayout from "@/Layouts/WelcomeLayout";
import PrimaryButton from "@/Components/PrimaryButton";
import LanguageDisplayer from "@/Components/LanguageDisplayer";
import { ShoppingBag } from "lucide-react";
import { useState } from "react";
import { router } from "@inertiajs/react";
import "../../../css/kioskApp.scss";

export default function Welcome({ images, language = null }) {
    const [overwrittenLanguage, setOverwrittenLanguage] = useState(null);
    const [currentPage, setCurrentPage] = useState(1);

    const setLanguage = (language) => {
        fetch(`/set-language/${language}`, {
            method: "GET",
        })
            .then((response) => response.json())
            .then((data) => {
                if (data.language) {
                    setOverwrittenLanguage(data.language);
                } else if (data.error) {
                    console.error(data.error);
                }
            })
            .catch((error) => {
                console.error("Error:", error);
            });
    };

    const setOrderType = (orderType) => {
        fetch(`/set-order-type/${orderType}`, {
            method: "GET",
        })
            .then((response) => response.json())
            .then((data) => {
                if (data.orderType) {
                    router.visit("/choose-order");
                } else if (data.error) {
                    console.error(data.error);
                }
            })
            .catch((error) => {
                console.error("Error:", error);
            });
    };

    return (
        <WelcomeLayout images={images} setLanguage={setLanguage}>
            {currentPage === 1 ? (
                <PrimaryButton onClick={() => setCurrentPage(2)} width={60}>
                    <ShoppingBag />
                    <LanguageDisplayer
                        language={overwrittenLanguage ?? language}
                        words={{
                            english: "Start Order",
                            dutch: "Bestelling Starten",
                            german: "Bestellung",
                        }}
                    />
                </PrimaryButton>
            ) : currentPage === 2 ? (
                <>
                    <PrimaryButton
                        onClick={() => setOrderType("Eat Here")}
                        width={40}
                    >
                        <LanguageDisplayer
                            language={overwrittenLanguage ?? language}
                            words={{
                                english: "Eat Here",
                                dutch: "Hier Eten",
                                german: "Hier Essen",
                            }}
                        />
                    </PrimaryButton>
                    <PrimaryButton
                        onClick={() => setOrderType("Take Away")}
                        width={40}
                    >
                        <LanguageDisplayer
                            language={overwrittenLanguage ?? language}
                            overwrittenLanguage={overwrittenLanguage}
                            words={{
                                english: "Take Away",
                                dutch: "Afhalen",
                                german: "Mitnehmen",
                            }}
                        />
                    </PrimaryButton>
                </>
            ) : null}
        </WelcomeLayout>
    );
}
