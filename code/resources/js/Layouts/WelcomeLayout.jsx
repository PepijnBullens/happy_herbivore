import styles from "../../css/Layouts/welcomeLayout.module.scss";
import React, { useState, useEffect } from "react";
import { motion, AnimatePresence } from "framer-motion";
import { wrap } from "@popmotion/popcorn";
import LanguageSelector from "@/Components/LanguageSelector";

const sliderVariants = {
    incoming: (direction) => ({
        x: direction > 0 ? "100%" : "-100%",
        scale: 1.2,
        opacity: 0,
    }),
    active: { x: 0, scale: 1, opacity: 1 },
    exit: (direction) => ({
        x: direction > 0 ? "-100%" : "100%",
        scale: 1,
        opacity: 0.2,
    }),
};

const sliderTransition = {
    duration: 1,
    ease: [0.56, 0.03, 0.12, 1.04],
};

export default function WelcomeLayout({ children, images, setLanguage }) {
    if (!images || images.length === 0) {
        return (
            <div className={styles.logo}>
                <img
                    src="/assets/logo/text-logo.png"
                    alt="Happy Herbivore logo"
                />
            </div>
        );
    }

    const [[imageCount, direction], setImageCount] = useState([0, 0]);

    const activeImageIndex = wrap(0, images.length, imageCount);

    const swipeToImage = (swipeDirection) => {
        setImageCount([imageCount + swipeDirection, swipeDirection]);
    };

    useEffect(() => {
        const intervalId = setInterval(() => {
            swipeToImage(1);
        }, 10000);

        return () => clearInterval(intervalId);
    }, [imageCount]);

    return (
        <>
            <div className={styles.logo}>
                <img
                    src="/assets/logo/text-logo.png"
                    alt="Happy Herbivore logo"
                />
            </div>
            <div className={styles.slider__container}>
                <div className={styles.slider}>
                    <AnimatePresence initial={false} custom={direction}>
                        <motion.div
                            key={activeImageIndex}
                            style={{
                                backgroundImage: `url(${images[activeImageIndex].path}`,
                            }}
                            custom={direction}
                            variants={sliderVariants}
                            initial="incoming"
                            animate="active"
                            exit="exit"
                            transition={sliderTransition}
                            className={styles.image}
                        />
                    </AnimatePresence>
                </div>
                <div className={styles.children}>{children}</div>
            </div>
            <LanguageSelector setLanguage={setLanguage} />
        </>
    );
}
