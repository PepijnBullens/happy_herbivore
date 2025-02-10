import styles from "../../css/Layouts/finishingOrderLayout.module.scss";
import { Link } from "@inertiajs/react";
import { ChevronLeft } from "lucide-react";

export default function FinishingOrderLayout({
    children,
    footer,
    back = null,
}) {
    return (
        <div className={styles.container}>
            <header>
                {back && (
                    <Link href={back}>
                        <ChevronLeft />
                    </Link>
                )}
                <img
                    src="/assets/logo/text-logo.png"
                    alt="Happy Herbivore logo"
                />
            </header>

            <div className={styles.content}>{children}</div>

            <footer>{footer}</footer>
        </div>
    );
}
