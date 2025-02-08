import { motion } from "framer-motion";
import { useState, useEffect } from "react";
import styles from "../../css/Components/chooseOrderModal.module.scss";

export default function ChooseOrderModal({
    children,
    setInspectedProduct,
    tryClosingModal,
    setTryClosingModal,
}) {
    const [isVisible, setIsVisible] = useState(true);

    useEffect(() => {
        if (!isVisible) {
            const timer = setTimeout(() => {
                setTryClosingModal(false);
                setInspectedProduct(null);
            }, 500);
            return () => clearTimeout(timer);
        }
    }, [isVisible, setInspectedProduct]);

    useEffect(() => {
        if (tryClosingModal) {
            setIsVisible(false);
        }
    }, [tryClosingModal]);

    return (
        <>
            <motion.div
                initial={{ opacity: 0 }}
                animate={{ opacity: isVisible ? 1 : 0 }}
                transition={{ duration: 0.5 }}
                className={styles.background}
                onClick={() => setIsVisible(false)}
            ></motion.div>
            <motion.div
                initial={{ y: "100%" }}
                animate={{ y: isVisible ? "-100%" : "100%" }}
                transition={{ type: "spring", stiffness: 100, damping: 20 }}
                className={styles.container}
            >
                {children}
            </motion.div>
        </>
    );
}
