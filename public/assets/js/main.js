{/* <script src=></script>
<script src=></script>
<script src= integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src= integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script> */}



import "https://cdn.jsdelivr.net/gh/mcstudios/glightbox/dist/js/glightbox.min.js" ;
import "https://code.jquery.com/jquery-3.6.0.min.js";
import "https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js";
import "https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js";
import "https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js";
export default function initializeComponents() {
    const lightbox = GLightbox({
    selector: ".glightbox",
    touchNavigation: true,
    loop: true,
    openEffect: "zoom",
    closeEffect: "fade",
    cssEfects: {
      // This are some of the animations included, no need to overwrite
      fade: {
        in: "fadeIn",
        out: "fadeOut",
      },
      zoom: {
        in: "zoomIn",
        out: "zoomOut",
      },
    },
  });

  const tooltipTriggerList = document.querySelectorAll(
    '[data-bs-toggle="tooltip"]'
  );
  const tooltipList = [...tooltipTriggerList].map(
    (tooltipTriggerEl) => new bootstrap.Tooltip(tooltipTriggerEl)
  );

  const toastTrigger = document.querySelectorAll(
    '[data-bs-toggle="toastTrigger"]'
  );
  const toastLiveExample = document.getElementById("liveToast");

  toastTrigger.forEach((element) => {
    if (element) {
      const toastBootstrap =
        bootstrap.Toast.getOrCreateInstance(toastLiveExample);
      element.addEventListener("click", () => {
        toastBootstrap.show();
      });
    }
  });
}
