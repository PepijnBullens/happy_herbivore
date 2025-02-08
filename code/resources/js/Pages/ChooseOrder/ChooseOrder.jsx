import { router } from "@inertiajs/react";

export default function ChooseOrder() {
    const back = () => {
        router.visit("/remove-order-type");
    };

    return (
        <div>
            <button onClick={back}>back</button>
        </div>
    );
}
