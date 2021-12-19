# Simple image controller

Zde je již obsah obrázku posílán php scriptem. Můžeme tedy lecos ovlivnit. URL adresa obrázku však není ideální:

```
<img src="img.php?f=7b0b50d6255637f2" alt="Ptáci na stromě" />
```

## Výhody

- Můžeme posílání obrázku řidit (práva, http hlavičku...).
- Neprozrazujeme umístění obrázku na serveru.

## Nevýhody

- Obrázek je zpracován scriptem, není to nejrychlejší.
- URL vůbec nenaznačuje obrázek. Není to USER ani SEO friendly.
