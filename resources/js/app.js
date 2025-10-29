import './bootstrap';
import '../css/app.css';
import './sidebar';
import 'quill/dist/quill.core.css';
import 'quill/dist/quill.snow.css';
import Quill from 'quill'; // <-- Tambahkan baris ini

// Ekstrak Quill ke window agar bisa diakses di tag <script> Blade
window.Quill = Quill; // <-- Tambahkan baris ini