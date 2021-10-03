import schuilhutMarker from "../assets/images/schuilhut.png";
import bankjeMarker from "../assets/images/bankje-marker.png";
import picnicBankIcon from "../assets/images/picnicBankje.png";
import schaduw from "../assets/images/schaduw.png";
import MapsCenterIcon from "../assets/images/MapsCenterIcon.png";
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


        // centerIcon() {
        //     return L.icon({
        //         iconUrl: MapsCenterIcon,
        //         iconSize: [40, 40], // size of the icon
        //         iconAnchor: [20, 20], // point of the icon which will correspond to marker's location
        //         className: 'user-location-icon'  // Om hem te stylen
        //     });
        // },

        centerIcon() {
            return L.divIcon({ className: 'pulsating-circle' })
        }

    },
};