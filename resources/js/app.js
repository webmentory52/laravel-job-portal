import "trix";
import "trix/dist/trix.css";
import '../../vendor/masmerise/livewire-toaster/resources/js';

document.addEventListener('alpine:init', () => {

    Alpine.store("jobs", {
        saved: JSON.parse(localStorage.getItem("savedJobs") || "[]"),

        isSaved(id) {
            return this.saved.includes(id);
        },

        toggleSave(id) {
            if(this.isSaved(id)) {
                this.saved = this.saved.filter(j => j !== id);
            } else {
                this.saved.push(id);
            }

            localStorage.setItem("savedJobs", JSON.stringify(this.saved));
        }
    });

});
