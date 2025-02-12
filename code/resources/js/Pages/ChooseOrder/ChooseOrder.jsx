import ChooseOrderLayout from "@/Layouts/ChooseOrderLayout";
import styles from "../../../css/chooseOrder.module.scss";
import { useState } from "react";
import LanguageDisplayer from "@/Components/LanguageDisplayer";
import DisplayMoney from "@/Components/DisplayMoney";
import "../../../css/kioskApp.scss";

export default function ChooseOrder({
    language,
    categories,
    category,
    popular,
    products,
    totalPrice,
}) {
    const [inspectedProduct, setInspectedProduct] = useState(null);

    return (
        <ChooseOrderLayout
            language={language}
            categories={categories}
            popular={popular}
            inspectedProduct={inspectedProduct}
            setInspectedProduct={setInspectedProduct}
            totalPrice={totalPrice}
        >
            <h2 className={styles.product__title}>- {category}</h2>

            <div className={styles.content}>
                {products.map((product, index) => (
                    <div
                        className={styles.product}
                        key={`product-${index}`}
                        onClick={() => setInspectedProduct(product)}
                    >
                        <img src={product.path} alt={product.alt} />
                        <div className={styles.product__info}>
                            <h2>{product.name}</h2>
                            <div className={styles.product__info__lower}>
                                <p>
                                    <DisplayMoney amount={product.price} />
                                </p>
                                <p>{product.kcal} kcal</p>
                            </div>
                        </div>
                    </div>
                ))}
            </div>

            <h2 className={styles.product__title}>
                -{" "}
                <LanguageDisplayer
                    language={language}
                    words={{
                        english: "Popular",
                        dutch: "Populair",
                        german: "Beliebt",
                    }}
                />
            </h2>

            <div className={styles.content}>
                {popular.map((product, index) => (
                    <div
                        className={styles.product}
                        key={`popular-${index}`}
                        onClick={() => setInspectedProduct(product)}
                    >
                        <img src={product.path} alt={product.alt} />
                        <div className={styles.product__info}>
                            <h2>{product.name}</h2>
                            <div className={styles.product__info__lower}>
                                <p>
                                    <DisplayMoney amount={product.price} />
                                </p>
                                <p>{product.kcal} kcal</p>
                            </div>
                        </div>
                    </div>
                ))}
            </div>
        </ChooseOrderLayout>
    );
}
