import './bootstrap';

import Alpine from 'alpinejs';
import AirDatepicker from 'air-datepicker';
import 'air-datepicker/air-datepicker.css';
import localeEn from 'air-datepicker/locale/en';


// Make it globally available
window.AirDatepicker = AirDatepicker;
window.localeEn = localeEn;
window.Alpine = Alpine;

Alpine.start();
