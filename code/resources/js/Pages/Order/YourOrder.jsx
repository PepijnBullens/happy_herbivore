import styles from "../../../css/yourOrder.module.scss";
import LanguageDisplayer from "@/Components/LanguageDisplayer";
import PrimaryButton from "@/Components/PrimaryButton";
import FinishingOrderLayout from "../../Layouts/FinishingOrderLayout";
import DisplayMoney from "@/Components/DisplayMoney";
import { WalletCards } from "lucide-react";
import { router } from "@inertiajs/react";

export default function YourOrder({ language, order, totalPrice, orderType }) {
    const updateQuantity = (id, quantity) => {
        fetch(`/update-quantity/${id}/${quantity}`, {
            method: "GET",
        })
            .then((response) => response.json())
            .then((data) => {
                if (data.order) {
                    router.reload();
                } else if (data.error) {
                    console.error(data.error);
                }
            })
            .catch((error) => {
                console.error("Error:", error);
            });
    };

    const increaseQuantity = (id, quantity) => updateQuantity(id, quantity + 1);
    const decreaseQuantity = (id, quantity) =>
        updateQuantity(id, quantity > 0 ? quantity - 1 : 0);

    const pay = () => {
        if (totalPrice > 0) {
            router.visit("/payment");
        }
    };

    return (
        <FinishingOrderLayout
            back={"/choose-order"}
            footer={
                <div className={styles.footer}>
                    <div className={styles.totalPrice}>
                        <small>
                            <LanguageDisplayer
                                language={language}
                                words={{
                                    dutch: "Totaal",
                                    english: "Total",
                                    german: "Gesamt",
                                }}
                            />
                        </small>
                        <h2>
                            <DisplayMoney amount={totalPrice} />
                        </h2>
                    </div>

                    <PrimaryButton onClick={pay}>
                        <WalletCards />
                        <LanguageDisplayer
                            language={language}
                            words={{
                                dutch: "Betaal",
                                english: "Pay",
                                german: "Bezahlen",
                            }}
                        />
                    </PrimaryButton>
                </div>
            }
        >
            <div className={styles.container}>
                {order.length === 0 ? (
                    <h2 className={styles.header}>
                        <LanguageDisplayer
                            language={language}
                            words={{
                                dutch: "Nog geen producten toegevoegd",
                                english: "No products have been added yet",
                                german: "Noch keine Produkte hinzugefügt",
                            }}
                        />
                    </h2>
                ) : (
                    <>
                        <div className={styles.upper}>
                            <h2 className={styles.header}>
                                <LanguageDisplayer
                                    language={language}
                                    words={{
                                        dutch: "Jouw bestelling",
                                        english: "Your order",
                                        german: "Ihre Bestellung",
                                    }}
                                />
                            </h2>
                            <h3 className={styles.order__type}>{orderType}</h3>
                        </div>
                        <div className={styles.order}>
                            {order.map((item, index) => (
                                <div className={styles.order__item} key={index}>
                                    <div className={styles.order__left}>
                                        <img src={item.path} alt={item.alt} />
                                        <div className={styles.order__info}>
                                            <h2>{item.name}</h2>
                                            <h3>
                                                <DisplayMoney
                                                    amount={item.totalPrice}
                                                />
                                            </h3>
                                        </div>
                                    </div>
                                    <div className={styles.selectors}>
                                        <button
                                            className={styles.remove}
                                            onClick={() =>
                                                decreaseQuantity(
                                                    item.id,
                                                    parseFloat(item.quantity)
                                                )
                                            }
                                        >
                                            <p>-</p>
                                        </button>
                                        <p>{item.quantity}</p>
                                        <button
                                            className={styles.add}
                                            onClick={() =>
                                                increaseQuantity(
                                                    item.id,
                                                    parseFloat(item.quantity)
                                                )
                                            }
                                        >
                                            <p>+</p>
                                        </button>
                                    </div>
                                </div>
                            ))}
                        </div>
                    </>
                )}
            </div>
        </FinishingOrderLayout>
    );
}
