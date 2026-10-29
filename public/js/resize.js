function resizeImage(file, maxWidth = 1000) {
    return new Promise((resolve, reject) => {
        const reader = new FileReader();
        reader.onload = event => {
            const img = new Image();
            img.onload = () => {
                const scale = maxWidth / img.width;
                const canvas = document.createElement("canvas");

                canvas.width = maxWidth;
                canvas.height = img.height * scale;

                const ctx = canvas.getContext("2d");
                ctx.drawImage(img, 0, 0, canvas.width, canvas.height);

                canvas.toBlob(blob => resolve(blob), "image/jpeg", 0.85);
            };
            img.src = event.target.result;
        };
        reader.onerror = reject;
        reader.readAsDataURL(file);
    });
}


//USAGE
const input = document.querySelector("#imageInput");

input.addEventListener("change", async () => {
    const file = input.files[0];
    const resized = await resizeImage(file, 1200);

    // Upload resized instead of original
    uploadToServer(resized);
});
