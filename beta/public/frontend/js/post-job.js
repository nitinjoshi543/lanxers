const meter = document.getElementById("progress--circle");
const meterProgress = document.getElementById("meter--progress");
const ranger = document.getElementById("meter--ranger");
const insideText = document.getElementById("progress--text");

if (ranger && meter && meterProgress && insideText) {
    ranger.addEventListener("input", e => {
        const rangeValue = e.target.value;

        meterProgress.innerText = `${rangeValue}`;
        insideText.textContent = `${rangeValue}`;
        meter.style.strokeDashoffset = 100 - rangeValue;

        if (rangeValue === "0") {
            meter.style.stroke = "none";
        } else {
            meter.style.stroke = "#00A148";
        }
    });

    ranger.addEventListener("wheel", e => {
        e.preventDefault();

        const isWheelPositive = () => e.deltaY > 0;

        if (isWheelPositive()) {
            let rangerValue = +ranger.value;
            ranger.value = rangerValue += 1;
        } else {
            ranger.value -= 1;
        }

        ranger.dispatchEvent(new Event("input"));
    });
}

document.addEventListener("DOMContentLoaded", () => {
    if (ranger) {
        ranger.dispatchEvent(new Event("input"));
    }

    // --- Step navigation + active indicator ---
    const stepIndicators = document.querySelectorAll(".stepIndicator ul li");
    const steps = {
        1: document.getElementById("step1"),
        2: document.getElementById("step2"),
        3: document.getElementById("step3")
    };

    function goToStep(stepNum) {
        Object.values(steps).forEach(step => {
            if (step) step.classList.add("d-none");
        });
        if (steps[stepNum]) steps[stepNum].classList.remove("d-none");

        stepIndicators.forEach((li, index) => {
            li.classList.toggle("active", index < stepNum);
        });
    }

    const openStep2 = document.getElementById("openStep2");
    const openStep3 = document.getElementById("openStep3");

    if (openStep2) {
        openStep2.addEventListener("click", e => {
            e.preventDefault();
            goToStep(2);
        });
    }
    if (openStep3) {
        openStep3.addEventListener("click", e => {
            e.preventDefault();
            goToStep(3);
        });
    }

    goToStep(1);

    // --- Job title letter count (max 80) ---
    const jobTitle = document.getElementById("jobTitle");
    const letterCount = document.querySelector("#step1 .lettercount");

    if (jobTitle && letterCount) {
        const updateLetterCount = () => {
            const len = jobTitle.value.length;
            letterCount.textContent = `${len}/80`;
        };
        jobTitle.addEventListener("input", updateLetterCount);
        updateLetterCount();
    }

    // --- Budget: numbers only ---
    const budgetInput = document.getElementById("budgetInput");
    if (budgetInput) {
        budgetInput.addEventListener("input", () => {
            budgetInput.value = budgetInput.value.replace(/\D/g, "");
        });
    }

    // --- Skills tags (max 10) ---
    const MAX_SKILLS = 10;
    const skills = [];
    const skillTagsEl = document.getElementById("skillTags");
    const skillInput = document.getElementById("skillInput");
    const skillCountEl = document.getElementById("skillcount");
    const skillsHidden = document.getElementById("skillsHidden");
    const suggestSkillsBtn = document.getElementById("suggestSkillsBtn");
    const skillsSuggestion = document.querySelector(".skillsuggetion");

    function updateSkillCount() {
        if (skillCountEl) skillCountEl.textContent = `${skills.length}/${MAX_SKILLS}`;
        if (skillsHidden) skillsHidden.value = skills.join(",");
        if (skillInput) {
            skillInput.disabled = skills.length >= MAX_SKILLS;
            if (skills.length >= MAX_SKILLS) skillInput.placeholder = "Maximum 10 skills reached";
            else skillInput.placeholder = "Add skills ( e.g Figma , react , node js )";
        }
    }

    function syncSuggestionSelected() {
        document.querySelectorAll(".skillsuggetion ul li").forEach(li => {
            const name = (li.textContent || "").trim().toLowerCase();
            const selected = skills.some(s => s.toLowerCase() === name);
            li.classList.toggle("selected", selected);
        });
    }

    function renderSkills() {
        if (!skillTagsEl) return;
        skillTagsEl.innerHTML = "";
        skills.forEach((skill, index) => {
            const tag = document.createElement("span");
            tag.className = "skill-tag";
            const label = document.createElement("span");
            label.textContent = skill;
            tag.appendChild(label);
            const removeBtn = document.createElement("button");
            removeBtn.type = "button";
            removeBtn.setAttribute("aria-label", "Remove skill");
            removeBtn.textContent = "×";
            removeBtn.addEventListener("click", () => {
                skills.splice(index, 1);
                renderSkills();
            });
            tag.appendChild(removeBtn);
            skillTagsEl.appendChild(tag);
        });
        updateSkillCount();
        syncSuggestionSelected();
    }

    function addSkill(raw) {
        const value = (raw || "").trim();
        if (!value) return false;
        if (skills.length >= MAX_SKILLS) return false;
        const exists = skills.some(s => s.toLowerCase() === value.toLowerCase());
        if (exists) return false;
        skills.push(value);
        renderSkills();
        return true;
    }

    function processSkillInput(value) {
        const parts = value.split(",");
        parts.forEach(part => addSkill(part));
        if (skillInput) skillInput.value = "";
    }

    if (skillInput) {
        skillInput.addEventListener("keydown", e => {
            if (e.key === "Enter") {
                e.preventDefault();
                processSkillInput(skillInput.value);
            } else if (e.key === ",") {
                e.preventDefault();
                processSkillInput(skillInput.value);
            } else if (e.key === "Backspace" && !skillInput.value && skills.length) {
                skills.pop();
                renderSkills();
            }
        });

        skillInput.addEventListener("input", () => {
            if (skillInput.value.includes(",")) {
                processSkillInput(skillInput.value);
            }
        });
    }

    document.querySelectorAll(".skillsuggetion ul li").forEach(li => {
        li.addEventListener("click", () => {
            addSkill(li.textContent);
        });
    });

    if (suggestSkillsBtn && skillsSuggestion) {
        suggestSkillsBtn.addEventListener("click", e => {
            e.preventDefault();
            skillsSuggestion.scrollIntoView({
                behavior: "smooth",
                block: "nearest"
            });
        });
    }

    updateSkillCount();

    // --- Attachment: drag/drop + filename ---
    const dropzone = document.getElementById("attachmentDropzone");
    const attachmentInput = document.getElementById("attachmentInput");
    const attachmentFilename = document.getElementById("attachmentFilename");
    const MAX_FILE_SIZE = 25 * 1024 * 1024;

    function showFilename(file) {
        if (!attachmentFilename || !dropzone) return;
        if (!file) {
            attachmentFilename.hidden = true;
            attachmentFilename.textContent = "";
            dropzone.classList.remove("has-file");
            return;
        }
        if (file.size > MAX_FILE_SIZE) {
            attachmentFilename.hidden = false;
            attachmentFilename.textContent = "File exceeds 25 MB limit";
            dropzone.classList.add("has-file");
            if (attachmentInput) attachmentInput.value = "";
            return;
        }
        attachmentFilename.hidden = false;
        attachmentFilename.textContent = file.name;
        dropzone.classList.add("has-file");
    }

    if (attachmentInput) {
        attachmentInput.addEventListener("change", () => {
            const file = attachmentInput.files && attachmentInput.files[0];
            showFilename(file || null);
        });
    }

    if (dropzone && attachmentInput) {
        ["dragenter", "dragover"].forEach(evt => {
            dropzone.addEventListener(evt, e => {
                e.preventDefault();
                e.stopPropagation();
                dropzone.classList.add("dragover");
            });
        });

        ["dragleave", "drop"].forEach(evt => {
            dropzone.addEventListener(evt, e => {
                e.preventDefault();
                e.stopPropagation();
                dropzone.classList.remove("dragover");
            });
        });

        dropzone.addEventListener("drop", e => {
            const files = e.dataTransfer && e.dataTransfer.files;
            if (!files || !files.length) return;
            const dt = new DataTransfer();
            dt.items.add(files[0]);
            attachmentInput.files = dt.files;
            showFilename(files[0]);
        });
    }
});