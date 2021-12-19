# Image controller

Zde si na zjednodušených příkladech ukážeme, jak můžeme řídit posílání obrázků ze serveru do prohlížeče.

Začneme [standardním zasláním obrázku](1-simple-image):

```
<img src="img/ptaci-na-strome.jpg" alt="Ptáci na stromě" />
```

Poté jej zkusíme poslat [vlastním skriptem](2-simple-image-controller):

```
<img src="img.php?f=7b0b50d6255637f2" alt="Ptáci na stromě" />
```

Oba tyto způsoby nám mnohé přináší ale mnohé omezují. První má prima URL a druhý nám nabízí kontrolu. Zkusíme to spojit do [třetího řešení](3-image-controller-better-url):

```
<img src="7b0b50d6255637f2/ptaci-na-strome.jpg" alt="Ptáci na stromě" />
```

Zde máme již prima URL a i posílání obrázku řeší náš vlastní program. Na posledním příkladu si ukážeme [řešení s malou galerkou s meta daty v JSON](4-mvc-gallery).

## Licence

Všechny použíté obrázky jsou Public domain z [wikiart.org](https://www.wikiart.org/).
