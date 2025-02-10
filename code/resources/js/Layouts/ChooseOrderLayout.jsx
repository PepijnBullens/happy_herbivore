import { router, Link } from "@inertiajs/react";
import { useState } from "react";
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

    const [total, setTotal] = useState(totalPrice ?? 0);

    const [tryClosingModal, setTryClosingModal] = useState(false);

    return (
        <>
            <main>
                <aside>
                    <div className={styles.aside__header}>
                        <div className={styles.aside__header__upper}>
                            <div
                                onClick={back}
                                className={styles.aside__header__upper__wrapper}
                            >
                                <ChevronLeft />
                            </div>
                            <CompactLanguageSelector language={language} />
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
        </>
    );
}
