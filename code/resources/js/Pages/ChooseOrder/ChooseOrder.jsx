import ChooseOrderLayout from "@/Layouts/ChooseOrderLayout";
import styles from "../../../css/chooseOrder.module.scss";
import { useState } from "react";

export default function ChooseOrder({
    language,
    categories,
    category,
    popular,
    products,
}) {
    const order = () => {
        console.log("order");
    };

    const [inspectedProduct, setInspectedProduct] = useState(null);

    return (
        <ChooseOrderLayout
            language={language}
            categories={categories}
            popular={popular}
            order={order}
            inspectedProduct={inspectedProduct}
            setInspectedProduct={setInspectedProduct}
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
                                <p>€{product.price}</p>
                                <p>{product.kcal} kcal</p>
                            </div>
                        </div>
                    </div>
                ))}
            </div>

            <h2 className={styles.product__title}>- Popular</h2>

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
                                <p>€{product.price}</p>
                                <p>{product.kcal} kcal</p>
                            </div>
                        </div>
                    </div>
                ))}
            </div>
        </ChooseOrderLayout>
    );
}
