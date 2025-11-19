# EmailJS Template-Inhalte

## Template 1: Admin-Benachrichtigung (für dich)

**Template Name:** `admin_notification`

**Subject:**
```
Neue Beta-Tester-Anmeldung: {{from_name}}
```

**Content (HTML):**
```html
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">
    <div style="max-width: 600px; margin: 0 auto; padding: 20px;">
        <h2 style="color: #4A90E2;">Neue Beta-Tester-Anmeldung für Twavio</h2>
        
        <div style="background-color: #f9f9f9; padding: 15px; border-radius: 5px; margin: 20px 0;">
            <p><strong>Name:</strong> {{from_name}}</p>
            <p><strong>E-Mail:</strong> {{from_email}}</p>
            <p><strong>Telefon:</strong> {{phone}}</p>
            <p><strong>Gerät:</strong> {{device}}</p>
            <p><strong>Newsletter:</strong> {{newsletter}}</p>
        </div>
        
        <div style="margin: 20px 0;">
            <h3 style="color: #4A90E2;">Motivation:</h3>
            <p style="white-space: pre-wrap; background-color: #f9f9f9; padding: 15px; border-radius: 5px;">{{motivation}}</p>
        </div>
        
        <hr style="border: none; border-top: 1px solid #ddd; margin: 30px 0;">
        
        <p style="color: #666; font-size: 12px;">
            Anmeldedatum: {{timestamp}}<br>
            Diese E-Mail wurde automatisch über das Beta-Tester-Anmeldeformular gesendet.
        </p>
    </div>
</body>
</html>
```

**Content (Plain Text - Alternative):**
```
Neue Beta-Tester-Anmeldung für Twavio

Name: {{from_name}}
E-Mail: {{from_email}}
Telefon: {{phone}}
Gerät: {{device}}
Newsletter: {{newsletter}}

Motivation:
{{motivation}}

---
Anmeldedatum: {{timestamp}}
Diese E-Mail wurde automatisch über das Beta-Tester-Anmeldeformular gesendet.
```

---

## Template 2: Bestätigungs-E-Mail (für Tester)

**Template Name:** `tester_confirmation`

**Subject:**
```
Beta-Tester-Anmeldung erhalten - Twavio
```

**Content (HTML):**
```html
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">
    <div style="max-width: 600px; margin: 0 auto; padding: 20px;">
        <h2 style="color: #4A90E2;">Hallo {{to_name}},</h2>
        
        <p>vielen Dank für dein Interesse an Twavio!</p>
        
        <p>Wir haben deine Anmeldung als Beta-Tester erhalten und freuen uns sehr, dass du uns bei der Entwicklung helfen möchtest.</p>
        
        <div style="background-color: #f9f9f9; padding: 15px; border-radius: 5px; margin: 20px 0;">
            <h3 style="color: #4A90E2; margin-top: 0;">Deine Anmeldedaten:</h3>
            <p><strong>Name:</strong> {{to_name}}</p>
            <p><strong>E-Mail:</strong> {{to_email}}</p>
            <p><strong>Gerät:</strong> {{device}}</p>
            <p><strong>Anmeldedatum:</strong> {{timestamp}}</p>
        </div>
        
        {{#if (eq newsletter "Ja")}}
        <p style="background-color: #e8f4f8; padding: 10px; border-radius: 5px; border-left: 4px solid #4A90E2;">
            ✓ Du wirst über Neuigkeiten und Updates per E-Mail informiert.
        </p>
        {{/if}}
        
        <!-- Alternative ohne Handlebars (einfacher): -->
        <!-- Einfach {{newsletter}} verwenden und im Template Text anpassen -->
        
        <p>Wir werden uns in Kürze bei dir melden, sobald die Beta-Version verfügbar ist.</p>
        
        <p>Bis dahin kannst du uns jederzeit unter <a href="mailto:info@twavio.com" style="color: #4A90E2;">info@twavio.com</a> erreichen.</p>
        
        <p style="margin-top: 30px;">
            Viele Grüße<br>
            <strong>Das Twavio Team</strong>
        </p>
        
        <hr style="border: none; border-top: 1px solid #ddd; margin: 30px 0;">
        
        <p style="text-align: center; color: #666; font-size: 12px;">
            <strong>Twavio</strong> - Gemeinsam reisen, gemeinsam erleben<br>
            <a href="mailto:info@twavio.com" style="color: #4A90E2;">info@twavio.com</a> | 
            <a href="https://twavio.com" style="color: #4A90E2;">https://twavio.com</a>
        </p>
    </div>
</body>
</html>
```

**Content (Plain Text - Alternative):**
```
Hallo {{to_name}},

vielen Dank für dein Interesse an Twavio!

Wir haben deine Anmeldung als Beta-Tester erhalten und freuen uns sehr, dass du uns bei der Entwicklung helfen möchtest.

Deine Anmeldedaten:
- Name: {{to_name}}
- E-Mail: {{to_email}}
- Gerät: {{device}}
- Anmeldedatum: {{timestamp}}

{{#if (eq newsletter "Ja")}}
Du wirst über Neuigkeiten und Updates per E-Mail informiert.

{{/if}}

<!-- Alternative (einfacher): -->
<!-- Wenn Newsletter: {{newsletter}} = "Ja", dann zeige Text -->
Wir werden uns in Kürze bei dir melden, sobald die Beta-Version verfügbar ist.

Bis dahin kannst du uns jederzeit unter info@twavio.com erreichen.

Viele Grüße
Das Twavio Team

---
Twavio - Gemeinsam reisen, gemeinsam erleben
info@twavio.com
https://twavio.com
```

---

## Wichtige Variablen für beide Templates:

Die folgenden Variablen werden vom JavaScript-Code gesendet:

**Für Admin-Template:**
- `{{from_name}}` - Name des Testers
- `{{from_email}}` - E-Mail des Testers
- `{{phone}}` - Telefonnummer (oder "Nicht angegeben")
- `{{device}}` - Gerät (iOS/Android)
- `{{newsletter}}` - "Ja" oder "Nein"
- `{{motivation}}` - Motivationstext
- `{{timestamp}}` - Anmeldedatum/Zeit

**Für Tester-Template:**
- `{{to_name}}` - Name des Testers
- `{{to_email}}` - E-Mail des Testers
- `{{device}}` - Gerät (iOS/Android)
- `{{timestamp}}` - Anmeldedatum/Zeit
- `{{newsletter}}` - "Ja" oder "Nein" (für bedingte Anzeige)

---

## Hinweise zur Einrichtung in EmailJS:

1. **Service einrichten:**
   - Gehe zu EmailJS Dashboard → Email Services
   - Füge einen neuen Service hinzu (z.B. Gmail)
   - Verbinde dein E-Mail-Konto (info@twavio.com)

2. **Templates erstellen:**
   - Gehe zu EmailJS Dashboard → Email Templates
   - Erstelle Template 1: "admin_notification"
   - Erstelle Template 2: "tester_confirmation"
   - Kopiere die Inhalte oben in die entsprechenden Templates

3. **Template-Variablen:**
   - EmailJS unterstützt automatisch alle Variablen, die im `templateParams` Objekt gesendet werden
   - Die Variablen müssen exakt so heißen wie im Code (z.B. `{{from_name}}`, `{{phone}}`, etc.)

4. **Reply-To einstellen:**
   - Im Template kannst du `{{reply_to}}` verwenden
   - Oder direkt im Code wird `reply_to` als Parameter gesendet

