import { router, Link } from "@inertiajs/react";
import { useState } from "react";
import styles from "../../css/chooseOrder.module.scss";
import PrimaryButton from "@/Components/PrimaryButton";
import { ChevronLeft } from "lucide-react";
import LanguageDisplayer from "@/Components/LanguageDisplayer";

export default function ChooseOrderLayout({
    children,
    language,
    categories,
    order,
}) {
    const back = () => {
        router.visit("/remove-order-type");
    };

    const [total, setTotal] = useState(0.0);

    return (
        <main>
            <aside>
                <div className={styles.aside__header}>
                    <div onClick={back} className={styles.aside__header__upper}>
                        <div className={styles.aside__header__upper__wrapper}>
                            <ChevronLeft />
                            <p>Back</p>
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
                                <img src={category.path} alt={category.alt} />
                                <div className={styles.category__name}>
                                    <h2>{category.name}</h2>
                                </div>
                            </Link>
                        ))}
                    </div>
                </div>
                <div className={styles.aside__footer}>
                    <PrimaryButton onClick={() => order}>
                        <LanguageDisplayer
                            language={language}
                            words={{
                                english: "Order",
                                dutch: "Bestel",
                                german: "Befehl",
                            }}
                        />
                    </PrimaryButton>
                    <h2>€{total}</h2>
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
    );
}
