import { Pipe, PipeTransform } from "@angular/core";

@Pipe({
    name: "customCurrency",
    standalone: true
})

export class CustomCurrencyPipe implements PipeTransform {
    transform(value: number, currencySymbol: string = '€', decimalSeparator: string = ',', thousandsSeparator: string = '.'): string {
        if (value == null) return '';
    
        let parts = value.toFixed(2).split('.');
        parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, thousandsSeparator);
        return currencySymbol + ' ' + parts.join(decimalSeparator);
    }
}