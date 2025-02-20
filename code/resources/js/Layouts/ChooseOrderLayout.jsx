import { router, Link } from "@inertiajs/react";
import { useState, useEffect } from "react";
import styles from "../../css/Layouts/chooseOrderLayout.module.scss";
import PrimaryButton from "@/Components/PrimaryButton";
import { ChevronLeft } from "lucide-react";
import LanguageDisplayer from "@/Components/LanguageDisplayer";
import ChooseOrderModal from "@/Components/ChooseOrderModal";
import OrderChooser from "@/Components/OrderChooser";
import CompactLanguageSelector from "../Components/CompactLanguageSelector";
import DisplayMoney from "@/Components/DisplayMoney";

export default function ChooseOrderLayout({
    children,
    language,
    categories,
    inspectedProduct,
    setInspectedProduct,
    totalPrice,
}) {
    const back = () => {
        router.visit("/reset-order");
    };

    const continueOrder = () => {
        setIsInactive(false);
        setInactiveCountdown(10);
    };

    const [total, setTotal] = useState(totalPrice ?? 0);

    const [tryClosingModal, setTryClosingModal] = useState(false);

    const [isInactive, setIsInactive] = useState(false);
    const [inactiveCountdown, setInactiveCountdown] = useState(10);

    useEffect(() => {
        let timeoutId;

        const resetTimer = () => {
            clearTimeout(timeoutId);
            timeoutId = setTimeout(() => setIsInactive(true), 60000);
        };

        const events = ["mousemove", "keydown", "mousedown", "touchstart"];

        events.forEach((event) => window.addEventListener(event, resetTimer));

        resetTimer();

        return () => {
            clearTimeout(timeoutId);
            events.forEach((event) =>
                window.removeEventListener(event, resetTimer)
            );
        };
    }, []);

    useEffect(() => {
        if (isInactive) {
            if (inactiveCountdown === 0) {
                setTryClosingModal(true);
                setTimeout(() => {
                    back();
                }, 1000);
            } else {
                const intervalId = setInterval(() => {
                    setInactiveCountdown(inactiveCountdown - 1);
                }, 1000);

                return () => clearInterval(intervalId);
            }
        }
    }, [isInactive, inactiveCountdown]);

    return (
        <>
            <main>
                <aside>
                    <div className={styles.aside__header}>
                        <div className={styles.aside__header__upper}>
                            <CompactLanguageSelector language={language} />
                            <div
                                onClick={back}
                                className={styles.aside__header__upper__wrapper}
                            >
                                <ChevronLeft />
                            </div>
                        </div>
                        <div className={styles.aside__header__content}>
                            {categories.map((category) => (
                                <Link
                                    href={`/choose-order/${category.name}`}
                                    className={styles.category}
                                    key={category.id}
                                    preserveScroll
                                    preserveState
                                >
                                    <img
                                        src={category.path}
                                        alt={category.alt}
                                    />
                                    <div className={styles.category__name}>
                                        <h2>{category.name}</h2>
                                    </div>
                                </Link>
                            ))}
                        </div>
                    </div>
                    <div className={styles.aside__footer}>
                        <Link href="/your-order">
                            <PrimaryButton width={80}>
                                <LanguageDisplayer
                                    language={language}
                                    words={{
                                        english: "Order",
                                        dutch: "Bestel",
                                        german: "Befehl",
                                    }}
                                />
                            </PrimaryButton>
                        </Link>
                        <h2>
                            <DisplayMoney amount={total} />
                        </h2>
                    </div>
                </aside>
                <section>
                    <nav className={styles.logo__header}>
                        <img
                            src="/assets/logo/text-logo.png"
                            alt="Happy Herbivore logo"
                        />
                    </nav>
                    <div className={styles.content__container}>{children}</div>
                </section>
            </main>
            {inspectedProduct && (
                <ChooseOrderModal
                    setInspectedProduct={setInspectedProduct}
                    tryClosingModal={tryClosingModal}
                    setTryClosingModal={setTryClosingModal}
                >
                    <OrderChooser
                        setTryClosingModal={setTryClosingModal}
                        product={inspectedProduct}
                        language={language}
                        setTotal={setTotal}
                    />
                </ChooseOrderModal>
            )}

            {isInactive && (
                <ChooseOrderModal
                    setInspectedProduct={setInspectedProduct}
                    tryClosingModal={tryClosingModal}
                    setTryClosingModal={setTryClosingModal}
                >
                    <div className={styles.inactive__modal}>
                        <div className={styles.inactive__modal__content}>
                            <h2>
                                <LanguageDisplayer
                                    language={language}
                                    words={{
                                        english: "Are you still there?",
                                        dutch: "Ben je er nog?",
                                        german: "Bist du noch da?",
                                    }}
                                />
                            </h2>
                            <div>{inactiveCountdown}</div>
                        </div>
                        <div className={styles.inactive__modal__buttons}>
                            <PrimaryButton onClick={back}>
                                Go Back
                            </PrimaryButton>
                            <PrimaryButton onClick={continueOrder}>
                                Continue
                            </PrimaryButton>
                        </div>
                    </div>
                </ChooseOrderModal>
            )}
        </>
    );
}
