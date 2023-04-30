# Red Color Alerts

<img src="https://github.com/dimagoltsman/ha-custom-lovelace-cards/blob/master/redcolor/screenshot.png?raw=true" height="400">


put js files in your www dir and add the js file to your resources in ui-lovelace.yaml
```
resources:

  - url: /local/content-card-redcolor.js
    type: js
```

configure your card and set a refresh rate(seconds)

```
- type: "custom:content-card-redcolor"
  refresh: 5
     
```
