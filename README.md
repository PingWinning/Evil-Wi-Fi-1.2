# Evil-Wi-Fi-1.2  

**Evil Wi-Fi 1.2** is an open-source project for **security awareness and training**.  
It simulates common rogue Wi-Fi scenarios (such as fake firmware update pages or captive portals) in a **safe, controlled environment**.  

The purpose is **educational only** — to help developers, students, and IT teams understand how these attacks look in practice and how to defend against them.  

---

<img width="843" height="628" alt="Image" src="https://github.com/user-attachments/assets/a8f8a09a-6ca5-43fa-9930-35c6703f8033" />

## 🔎 How such attacks work (Educational Explanation)

Attackers often exploit Wi-Fi networks by combining several techniques:  

1. **Deauthentication (Deauth) Attacks**  
   - The attacker sends forged deauthentication packets to a client device, forcing it to disconnect from the legitimate router.  
   - The victim is then pushed to reconnect without realizing what happened.  

2. **Evil Twin / Rogue Access Point**  
   - The attacker creates a fake Wi-Fi access point with the **same SSID (network name)** as the victim’s real router.  
   - The victim’s device may automatically connect to the attacker’s AP if it seems stronger or more visible.  

3. **Phishing for Credentials**  
   - Once connected, the victim is redirected to a **malicious portal page** (e.g., a fake firmware update or router login screen).  
   - The portal tricks the victim into entering their Wi-Fi password or other sensitive details.  

⚠️ **Note:** Evil-Wi-Fi-1.2 does not perform real attacks.  
It is a **simulation only**, meant for **training and awareness purposes**.  

---

## Current Progress

- Added initial **`index.php`** file (basic simulation page).  
- Upcoming: helpers, JS assets, and extended modules to make the simulation flow more realistic.  
- Planned integration with **Hak5 WiFi Pineapple Mark VII** for demonstrations in controlled pentest labs (educational only).  

---

## 🎯 Project Goals

- Provide a realistic **demo environment** for security awareness training.  
- Show how attackers use tools like the **WiFi Pineapple** to simulate rogue AP attacks.  
- Train end-users to **recognize phishing-style Wi-Fi portals**.  

---

## 📌 Roadmap / Community Note

This is a **personal project**, and development is ongoing in my free time.  
If the community is interested in contributing, whether by improving the UI, adding JS assets, or expanding documentation, contributions are welcome.  

I’ll continue to build on this, but progress may be gradual.  

---

## ⚖️ Disclaimer

This project is intended **for educational purposes only**.  
It must be used responsibly and only in **controlled environments**.  
The author does not condone or take responsibility for misuse.  

---

## 🚀 Getting Started

(coming soon – to be documented in future updates)  

---

Made with 🔒 for **security awareness**.  
