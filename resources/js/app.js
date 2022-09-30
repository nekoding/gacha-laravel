import axios from "axios";
import "./bootstrap";
import "./Winwheel";

const fetchRewards = async () => {
    const res = await axios.get("/");
    return await res.data;
};

const getLuckyNumbers = async () => {
    const res = await axios.get("/spin");
    return await res.data;
};

// load winwheel
document.addEventListener("DOMContentLoaded", async () => {
    const data = await fetchRewards();
    let wheelSpinning = false;

    // Create new wheel object specifying the parameters at creation time.
    let theWheel = new Winwheel({
        outerRadius: 212,
        innerRadius: 75,
        textFontSize: 24,
        textOrientation: "horizontal",
        textAlignment: "outer",
        numSegments: data.length,
        segments: data.map((item, index) => {
            return {
                fillStyle: item.color,
                text: item.name,
            };
        }),
        animation: {
            type: "spinToStop",
            duration: 10,
            spins: 10,
            callbackFinished: (res) => {
                alert("winner " + res.text);
            },
            callbackSound: playSound,
            soundTrigger: "pin",
        },
        pins: {
            number: data.length,
            fillStyle: "silver",
            outerRadius: 4,
        },
    });

    // Loads the tick audio sound in to an audio object.
    let audio = new Audio("tick.mp3");

    // This function is called when the sound is to be played.
    function playSound() {
        // Stop and rewind the sound if it already happens to be playing.
        audio.pause();
        audio.currentTime = 0;

        // Play the sound.
        audio.play();
    }

    async function startSpin() {
        const data = await getLuckyNumbers();
        document.getElementById("luckyNumber").innerText = JSON.stringify(
            data.data
        );
        resetWheel();
        if (wheelSpinning == false) {
            theWheel.animation.spins = 10;
            theWheel.animation.stopAngle = data.data[0];
            theWheel.startAnimation();
            wheelSpinning = true;
        }
    }

    function resetWheel() {
        theWheel.stopAnimation(false); // Stop the animation, false as param so does not call callback function.
        theWheel.rotationAngle = 0; // Re-set the wheel angle to 0 degrees.
        theWheel.draw(); // Call draw to render changes to the wheel.

        wheelSpinning = false; // Reset to false to power buttons and spin can be clicked again.
    }

    const btnSpin = document.getElementById("btnSpin");
    btnSpin.addEventListener("click", (e) => {
        startSpin();
    });
});
