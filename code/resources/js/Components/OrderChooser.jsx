import styles from "../../css/Components/orderChooser.module.scss";
import LanguageDisplayer from "@/Components/LanguageDisplayer";
import PrimaryButton from "@/Components/PrimaryButton";
import { useState } from "react";

export default function OrderChooser({
    product,
    language,
    setTryClosingModal,
    setTotal,
}) {
    const addToOrder = () => {
        // Add the product to the order
        fetch(`/add-to-order/${product.id}/${quantity}`, {
            method: "GET",
        })
            .then((response) => response.json())
            .then((data) => {
                if (data.order && data.totalPrice) {
                    setTotal(data.totalPrice);
                    setTryClosingModal(true);
                } else if (data.error) {
                    console.error(data.error);
                }
            })
            .catch((error) => {
                console.error("Error:", error);
            });
    };

    const [quantity, setQuantity] = useState(1);

    const increaseQuantity = () => setQuantity(quantity + 1);
    const decreaseQuantity = () => setQuantity(quantity > 1 ? quantity - 1 : 1);

    return (
        <div className={styles.container}>
            <div className={styles.info__wrapper}>
                <img src={product.path} alt={product.alt} />
                <div className={styles.info}>
                    <h2 className={styles.name}>{product.name}</h2>
                    <p className={styles.description}>{product.description}</p>

                    <div>
                        <div className={styles.selectors}>
                            <button
                                className={styles.remove}
                                onClick={() => decreaseQuantity()}
                            >
                                <p>-</p>
                            </button>
                            <p>{quantity}</p>
                            <button
                                className={styles.add}
                                onClick={() => increaseQuantity()}
                            >
                                <p>+</p>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <PrimaryButton onClick={addToOrder}>
                <LanguageDisplayer
                    language={language}
                    words={{
                        english: "Add To Order",
                        dutch: "Toevoegen aan bestelling",
                        german: "Zur Bestellung hinzufügen",
                    }}
                />
            </PrimaryButton>
        </div>
    );
}
