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

displayDoctorSchedules();
