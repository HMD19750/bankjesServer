import schuilhutMarker from "../assets/images/schuilhut.png";
import bankjeMarker from "../assets/images/bankje-marker.png";
import picnicBankIcon from "../assets/images/picnicBankje.png";
import addedMarker from "../assets/images/bankje-groen.png";
import deletedMarker from "../assets/images/bankje-rood.png";
import schaduw from "../assets/images/schaduw.png";
import L from "leaflet";

export default {


    computed: {


        // Initialiseer een Icon object
        bankjeIcon() {
            return L.icon({
                iconUrl: bankjeMarker,
                iconSize: [20, 32], // size of the icon
                iconAnchor: [10, 32], // point of the icon which will correspond to marker's location
                shadowUrl: schaduw,
                shadowSize: [20, 32],
                shadowAnchor: [0, 32],
            });
        },

        schuilhutIcon() {
            return L.icon({
                iconUrl: schuilhutMarker,
                iconSize: [20, 32], // size of the icon
                iconAnchor: [10, 32], // point of the icon which will correspond to marker's location
                shadowUrl: schaduw,
                shadowSize: [20, 32],
                shadowAnchor: [0, 32],
            });
        },


        picnicBankjeIcon() {
            return L.icon({
                iconUrl: picnicBankIcon,
                iconSize: [20, 32], // size of the icon
                iconAnchor: [10, 32], // point of the icon which will correspond to marker's location
                shadowUrl: schaduw,
                shadowSize: [20, 32],
                shadowAnchor: [0, 32],
            });
        },

        addedIcon() {
            return L.icon({
                iconUrl: addedMarker,
                iconSize: [20, 32], // size of the icon
                iconAnchor: [10, 32], // point of the icon which will correspond to marker's location
                shadowUrl: schaduw,
                shadowSize: [20, 32],
                shadowAnchor: [0, 32],
            });
        },

        deletedIcon() {
            return L.icon({
                iconUrl: deletedMarker,
                iconSize: [20, 32], // size of the icon
                iconAnchor: [10, 32], // point of the icon which will correspond to marker's location
                shadowUrl: schaduw,
                shadowSize: [20, 32],
                shadowAnchor: [0, 32],
            });
        },


        centerIcon() {
            return L.divIcon({ className: 'pulsating-circle' })
        }

    },
};