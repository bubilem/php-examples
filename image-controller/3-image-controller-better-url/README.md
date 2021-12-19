# Simple image controller with better url

Obsah obrázku je posílán php scriptem. Můžeme tedy lecos ovlivnit. Pomocí konfigurace apache jsme již mohli doladit i URL obrázku, která na první pohled vypadá jako URL běžného obrázku:

```
<img src="7b0b50d6255637f2/ptaci-na-strome.jpg" alt="Ptáci na stromě" />
```

## Výhody

- Můžeme posílání obrázku řidit (práva, http hlavičku...).
- Neprozrazujeme umístění obrázku na serveru.
- Klasická URL pro obrázek

## Nevýhody

- Obrázek je zpracován scriptem, není to nejrychlejší.
