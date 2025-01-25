function saveDoctorSchedule(event) {
    event.preventDefault();

    const doctorId = document.getElementById("doctor-id").value;
    const doctorName = document.getElementById("doctor-name").value;
    const availability = document.getElementById("availability").value.split(",").map(day => day.trim());

    const doctor = {
        id: doctorId,
        name: doctorName,
        availability: availability
    };

    fetch("save_schedule.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify(doctor),
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert("Schedule saved successfully!");
                displayDoctorSchedules();
            } else {
                alert("Error saving schedule.");
            }
        })
        .catch(error => console.error("Error:", error));

    document.getElementById("schedule-form").reset();
}

function displayDoctorSchedules() {
    fetch("schedules.json")
        .then(response => response.json())
        .then(data => {
            const doctorList = document.getElementById("doctor-list");
            doctorList.innerHTML = ""; 

            if (data.length === 0) {
                doctorList.innerHTML = "<p>No schedules available.</p>";
                return;
            }

            data.forEach(doctor => {
                const doctorCard = document.createElement("div");
                doctorCard.classList.add("doctor-card");
                doctorCard.innerHTML = `
                    <h3>Doctor ID: ${doctor.id}</h3>
                    <p>Name: ${doctor.name}</p>
                    <p>Available Days: ${doctor.availability.join(", ")}</p>
                `;
                doctorList.appendChild(doctorCard);
            });
        })
        .catch(error => console.error("Error fetching schedules:", error));
}

document.getElementById("schedule-form").addEventListener("submit", saveDoctorSchedule);

displayDoctorSchedules();
