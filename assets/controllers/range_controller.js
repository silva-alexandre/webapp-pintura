// assets/controllers/range_controller.js
import { Controller } from "@hotwired/stimulus";

export default class extends Controller {
    static targets = ["range", "valueLabel", "priceDisplay"];

    connect() {
        this.updateValueLabel();
        this.updateTotalPrice();
    }

    update() {
        this.updateValueLabel();
        this.updateTotalPrice();
    }

    updateValueLabel() {
        const value = this.rangeTarget.value;
        this.valueLabelTarget.textContent = `${value} m²`;
    }

    updateTotalPrice() {
        const value = parseFloat(this.rangeTarget.value);
        const pricePerSquareMeter = parseFloat(this.rangeTarget.dataset.price);
        const totalPrice = (value * pricePerSquareMeter).toFixed(2);
        this.priceDisplayTarget.textContent = totalPrice;
    }
}
