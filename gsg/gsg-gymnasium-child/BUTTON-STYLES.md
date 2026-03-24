# GSG Button Styles Guide

## 🎨 Verfügbare Button-Varianten

Das Theme bietet zwei vorgefertigte Button-Styles:

### 1. Primary Button (Standard - Gelb)

**Aussehen:**
- Gelber Hintergrund (#E5B533)
- Navy Text (#1E3A5F)
- Schatten-Effekt

**Verwendung:**
```
Einfach Button einfügen - kein Style auswählen
```

**Im Editor:**
```
(+) > Button einfügen
Text eingeben
Fertig! (Standard ist Primary)
```

---

### 2. Outline Button (Navy Border)

**Aussehen:**
- Transparenter Hintergrund
- Navy Border (2px)
- Navy Text

**Verwendung:**
```
Button einfügen
Sidebar rechts > Styles > "Outline" auswählen
```

**Im Editor:**
```
(+) > Button einfügen
Sidebar > Button > Styles > Outline
```

---

## ✨ Interaktive States

Alle Buttons haben folgende States:

### **Hover (Maus drüber)**
- Primary: Wird Gold (#D4A017)
- Outline: Füllt sich mit Navy
- Animation: Hebt sich 2px nach oben
- Schatten wird stärker

### **Focus (Tastatur-Navigation)**
- Outline: 3px farbige Umrandung
- Primary: Navy Outline
- Outline: Yellow Outline
- Offset: 3px (gut sichtbar)

### **Active (Während Klick)**
- Kehrt zur Ausgangsposition zurück
- Schatten wird kleiner
- Fühlt sich "gedrückt" an

---

## 📏 Button-Größen

**Alle Buttons haben einheitliche Größe:**
- Padding: 1rem (oben/unten) × 2rem (links/rechts)
- Min-Height: 48px (WCAG Touch-Target)
- Font-Size: 1rem
- Font-Weight: 600 (Semi-Bold)
- Border-Radius: 8px

**Warum einheitlich?**
→ Professionelles Erscheinungsbild
→ Bessere UX (User weiß: "Das ist ein Button")
→ WCAG-konform (Mindestgröße)

---

## 🎯 Verwendung in Patterns

### Primary Button (Call-to-Action)
```
Für wichtige Aktionen:
- "Jetzt anmelden"
- "Mehr erfahren"
- "Kontakt aufnehmen"
- "Tickets kaufen"
```

### Outline Button (Sekundär)
```
Für weniger wichtige Aktionen:
- "Zurück"
- "Abbrechen"
- "Weitere Informationen"
- "Virtueller Rundgang"
```

---

## 🎨 Anpassungen

### Farbe ändern (Individual)

**Im Editor:**
```
Button auswählen
Sidebar > Block > Settings
Color Settings
→ Background ändern
→ Text Color ändern
```

**Eigene Farbe:**
```
Button auswählen
Sidebar > Color > Custom
→ Hex-Code eingeben
```

### Größe ändern (Individual)

**Nicht empfohlen, aber möglich:**
```css
/* In Additional CSS: */
.my-big-button .wp-block-button__link {
    padding: 1.5rem 3rem !important;
    font-size: 1.2rem !important;
}
```

Dann Button-Klasse im Editor: `my-big-button`

---

## 💡 Best Practices

### ✅ DO:
- Primary für Haupt-Aktionen verwenden
- Outline für Sekundär-Aktionen
- Max. 2 Buttons nebeneinander
- Klare Button-Texte ("Jetzt anmelden" statt "Klick hier")

### ❌ DON'T:
- Mehr als 2 Primary Buttons nebeneinander
- Buttons ohne Text (nur Icon)
- Zu lange Button-Texte (max. 3-4 Wörter)
- Buttons in Fließtext (besser: Link)

---

## 🔧 Technische Details

### CSS Custom Properties (theme.json)

**Primary Button:**
```json
{
  "background": "var(--wp--preset--color--gsg-yellow)",
  "text": "var(--wp--preset--color--gsg-navy)",
  "hover": {
    "background": "var(--wp--preset--color--gsg-gold)",
    "transform": "translateY(-2px)",
    "shadow": "0 6px 20px rgba(229, 181, 51, 0.4)"
  }
}
```

**Outline Button:**
```json
{
  "background": "transparent",
  "border": "2px solid navy",
  "hover": {
    "background": "navy",
    "text": "white"
  }
}
```

### Animation Timing

```css
transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
```

**Was bedeutet das?**
- 0.3s: Animation dauert 300ms
- cubic-bezier: Smooth Easing (nicht linear)
- all: Alle Properties werden animiert

---

## ♿ Accessibility Features

### ✅ Implementiert:

1. **Mindestgröße**
   - 48px × 48px (WCAG 2.1 Level AAA)

2. **Focus Outline**
   - 3px Outline
   - 3px Offset
   - Kontrastreich

3. **:focus-visible Support**
   - Outline nur bei Tastatur
   - Nicht bei Maus-Klick

4. **Hover Feedback**
   - Visuelles Feedback
   - Transform + Shadow

5. **Active State**
   - Zeigt "gedrückt" an
   - Wichtig für Touch-Devices

6. **Reduced Motion**
   - Respektiert User-Präferenz
   - Keine Animation wenn gewünscht

---

## 📱 Responsive Verhalten

**Desktop:**
- Normale Größe
- Volle Animationen
- Hover-Effekte

**Tablet:**
- Gleiche Größe
- Touch-optimiert
- Schnellere Transitions

**Mobile:**
- Größere Touch-Targets
- Instant Feedback
- Keine Hover (Touch hat kein Hover)

---

## 🎨 Beispiel-Kombinationen

### Hero Section:
```
Primary Button (Gelb)    + Outline Button (Weiß)
"Jetzt anmelden"         + "Virtueller Rundgang"
```

### Content Section:
```
Primary Button (Gelb)
"Mehr erfahren"
```

### Footer CTA:
```
Primary Button (Gelb)    + Outline Button (Navy)
"Kontakt aufnehmen"      + "Anfahrt"
```

---

## 🐛 Troubleshooting

### Button hat falsche Größe?

**Lösung:**
```
Browser-Cache leeren (Strg + Shift + R)
style.css sollte geladen sein
```

### Hover funktioniert nicht?

**Prüfe:**
```
1. Browser-DevTools (F12)
2. Element inspizieren
3. :hover State manuell aktivieren
4. CSS prüfen ob überschrieben
```

### Focus Outline fehlt?

**Lösung:**
```css
/* In Additional CSS falls nötig: */
.wp-block-button__link:focus-visible {
    outline: 3px solid var(--wp--preset--color--gsg-yellow) !important;
    outline-offset: 3px !important;
}
```

---

## ✅ Checkliste

Nach Theme-Installation:

- [ ] Primary Button ist gelb
- [ ] Outline Button hat Navy Border
- [ ] Hover: Button hebt sich an
- [ ] Focus: Outline ist sichtbar
- [ ] Active: Button wirkt gedrückt
- [ ] Alle Buttons gleiche Größe
- [ ] Animation smooth (0.3s)
- [ ] Mindestgröße 48px
- [ ] Reduced Motion wird respektiert

---

**Alle Button-Styles sind fertig konfiguriert! Einfach Button einfügen und loslegen!** 🎉
