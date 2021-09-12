<template>
  <div class="modal-mask">
    <div class="modal-wrapper">
      <div class="modal-container">
        <div class="modal-header">
          <h3>Over deze app</h3>
        </div>

        <div class="modal-body">
          <h1>Menu knoppen</h1>
          <table>
            <tr>
              <td>
                <i class="menuIcon fas fa-location-arrow"></i>
              </td>
              <td>Ga naar huidige positie</td>
            </tr>
            <tr>
              <td>
                <i class="menuIcon fas fa-plus"></i>
              </td>
              <td>Voeg een nieuw bankje toe</td>
            </tr>

            <tr>
              <td>
                <i class="menuIcon fas fa-minus"></i>
              </td>
              <td>Verwijder een bankje dat er niet meer is</td>
            </tr>
          </table>

          <h1>Markers</h1>
          <table>
            <tr>
              <td>
                <img
                  src="../assets/images/bankje-marker.png"
                  width="18"
                  height="27"
                />
              </td>
              <td>Bankje</td>
            </tr>
            <tr>
              <td>
                <img
                  src="../assets/images/picnicBankje.png"
                  width="18"
                  height="27"
                />
              </td>
              <td>Picnicbank</td>
            </tr>

            <tr>
              <td>
                <img
                  src="../assets/images/schuilhut.png"
                  width="18"
                  height="27"
                />
              </td>
              <td>Schuilhut</td>
            </tr>
          </table>

          <h1>Bankjes toevoegen of verwijderen</h1>
          <p>
            U kunt zelf een bankje toevoegen. Of een bankje verwijderen omdat
            het niet meer bestaat.
          </p>

          <h1>Aantal bankjes</h1>
          <p>
            Om het scherm niet te vol te maken laten we iedere keer slechts een
            beperkt aantal bankjes zien. Als u inzoomt kunnen er dus nieuwe
            bankjes verschijnen. Het aantal zichtbare bankjes wordt rechtsonder
            op het scherm getoond.
          </p>

          <h1>Gebied</h1>
          <p>
            Op dit moment bevat onze database alleen bankjes, picnicbankjes en
            schuilhutten in Nederland en Belgie.
          </p>

          <h1>App voor Android</h1>
          <p>
            Voor Android is er een speciale app met dezelfde functionaliteit als
            deze website. Je vind hem in de Google Playstore onder de naam "
            Wandelbankjes"
          </p>

          <h1>Feedback</h1>
          <p>
            Ondervind u problemen? Of heeft u suggesties? Stuur dan een email
            naar:
            <a href="mailto:helpdesk@evenuitrusten.nl">helpdesk</a>
          </p>

          <div style="text-align: center">
            <button type="button" @click="closeModal">Ga terug</button>
            <p>U aangeboden door</p>
            <a href="https://www.deijsmannetjes.nl">
              <img src="../assets/images/ijsmannetjesbanner.png" width="150" />
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { defineComponent } from "vue";
import { eventHub } from "../app.js";

export default defineComponent({
  name: "DocumentationModal",

  methods: {
    closeModal() {
      console.log("Menubar.vue: Emitted closeDocumentation");
      eventHub.emit("closeDocumentation");
    },
  },
});
</script>

<style scoped>
p,
td {
  font-size: 0.75em;
  margin-top:2px;
}

button {
  border-radius: 10px;
  background-color: #3dc2ff;
  outline: none;
  padding: 10px;
  border: none;
  color: white;
  transition-duration: 0.4s;
}

button:hover {
  background-color: #42b983; /* Green */
  color: white;
}

.no-scroll {
  --overflow: hidden;
}

.justify-content-center {
  text-align: center;
}

.blue {
  --background: #def0c7;
}

h1 {
  font-size: medium;
  font-weight: bold;
  margin-bottom: 2px;
}

.modal-mask {
  position: fixed;
  z-index: 9998;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5);
  display: table;
}

.modal-wrapper {
  display: table-cell;
  vertical-align: middle;
}

.modal-container {
  width: 300px;
  margin: 0px auto;
  padding: 20px 30px;
  background-color: #fff;
  border-radius: 2px;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.33);
  font-family: Helvetica, Arial, sans-serif;
}

.modal-header h3 {
  margin-top: 0;
  color: #42b983;
  font-weight: bold;
}

.modal-body {
  margin: 20px 0;
}

.modal-default-button {
  display: block;
  margin-top: 1rem;
}

/*
 * The following styles are auto-applied to elements with
 * transition="modal" when their visibility is toggled
 * by Vue.js.
 *
 * You can easily play with the modal transition by editing
 * these styles.
 */

.modal-enter-active,
.modal-leave-active {
  transition: opacity 0.5s ease;
}

.modal-enter-from,
.modal-leave-to {
  opacity: 0;
}
</style>
