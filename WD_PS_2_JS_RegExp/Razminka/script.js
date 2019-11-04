// Task1 
function calculateSum() {
    let firstNum = Number(document.getElementById("firstNum").value);
    let secondNum = Number(document.getElementById("secondNum").value);
    let sum = 0;

    if (firstNum > secondNum) {
        let storage = firstNum;
        firstNum = secondNum;
        secondNum = storage;
    }

    while (firstNum <= secondNum) {
        let i = Math.abs(firstNum) % 10;
        if (i == 2 | i == 3 | i == 7) {
            sum += firstNum;
        }
        firstNum++;
    }

    document.getElementById("answerTask1").innerHTML = "Result is: " + " " + sum;
}




// Task2
function calculateTimeFromSeconds() {
    let timeInput = document.getElementById("secondsInput").value;
    const oneSecond = 1000;
    let hour, minute, sec;
    let timeResult = "";

    timeInput *= oneSecond;
    let timetmp = new Date(timeInput);
    hour = timetmp.getHours();
    minute = timetmp.getMinutes();
    sec = timetmp.getSeconds();
    timeResult = "Result is: " + (String(hour).length < 2 ? "0" + hour : hour) + ":" +
        (String(minute).length < 2 ? "0" + minute : minute) + ":" +
        (String(sec).length < 2 ? "0" + sec : sec);

    document.getElementById("answerTask2a").innerHTML = timeResult;

}



// Task2
function calculateTimeInSeconds() {
    let sec = 0;
    const capacityHour = 3600;
    const capacityMinute = 60;
    let timeInput = document.getElementById("timeInput").value;
    let timeArray = timeInput.split(":");

    sec += (Number(timeArray[0]) * capacityHour) + (Number(timeArray[1]) *
        capacityMinute) + Number(timeArray[2]);
    document.getElementById("answerTask2b").innerHTML = "Result is: " + sec;

}



// Task3
function calculateTimeBetween() {
    // First Solution to this exercises 
    // ______________________________________________

    let year = 0,
        month = 0,
        day = 0,
        hour = 0,
        min = 0,
        sec = 0;

    let fisrtTime = document.getElementById("timeLocal1").value;
    let secondTime = document.getElementById("timeLocal2").value;
    let result = document.getElementById("answerTask3");

    if (fisrtTime === "" || fisrtTime === null || secondTime === "" || secondTime === null) {
        result.innerHTML = "Enter dates and time completely";
        return;
    }

    let fisrtTimeMil = new Date(fisrtTime).getTime();
    let secondTimeMil = new Date(secondTime).getTime();
    let difference = secondTimeMil - fisrtTimeMil;

    const milInSecond = 1000;
    const secInMinute = 60;
    const minInHour = 60;
    const hourInDay = 24;
    const dayInMonth = 31;
    const monthInYear = 12;

    sec = Math.floor(difference / milInSecond) % secInMinute;
    min = Math.floor(difference / (milInSecond * secInMinute)) % minInHour;
    hour = Math.floor(difference / (milInSecond * secInMinute * minInHour)) % hourInDay;
    day = Math.floor(difference / (milInSecond * secInMinute * minInHour * hourInDay)) % dayInMonth;
    month = Math.floor(difference / (milInSecond * secInMinute * minInHour * hourInDay * dayInMonth)) % monthInYear;
    year = Math.floor(difference / (milInSecond * secInMinute * minInHour * hourInDay * dayInMonth * monthInYear));

    result.innerHTML = year + " year (s), " +
        month + " month (s), " +
        day + " day (s), " +
        hour + " hour (s), " +
        min + " min (s), " +
        sec + " sec (s). ";


    // // Second Solution to this exercises
    //    // ______________________________________________

    //    let startTime = 1970;
    //    let fisrtTime = document.getElementById("timeLocal1").value;
    //    let secondTime = document.getElementById("timeLocal2").value;
    //   let result = document.getElementById("answerTask3");

    // if (fisrtTime === "" || fisrtTime === null) {
    //     result.innerHTML = "Enter dates and time completely";
    //     return;
    // }
    //    let fisrtTimeMil = new Date(fisrtTime).getTime();
    //    let secondTimeMil = new Date(secondTime).getTime();
    //    let difference = secondTimeMil - fisrtTimeMil;

    //    let newTime = new Date(difference);
    //    alert(new Date(newTime));
    //    document.getElementById("answerTask3").innerHTML = ((newTime.getFullYear() - startTime) + " year (s)" +
    //        " " + newTime.getMonth() + " month (s)" +
    //        " " + (newTime.getDate() - 1) + " day (s)" +
    //        " " + newTime.getHours() + " hours (s)" +
    //        " " + newTime.getMinutes() + " minutes" +
    //        " " + newTime.getSeconds() + " second (s)");
}




// Task4
function drawChessboard() {
    let inputChessSize = document.getElementById("chess").value;
    let answerTask4 = document.getElementById('answerTask4');
    answerTask4.innerHTML = "";
    let tryAgain = document.getElementById("tryAgain");
    let regex = /x/i;
    let chessSizeArray = inputChessSize.split(regex);
    let x = chessSizeArray[0];
    let y = chessSizeArray[1];
    let flag = true;
    const widthOfSquare = 50; 
    
    let maxWidth = (document.getElementById("wrapper").offsetWidth / widthOfSquare) - 1;
   
    if (chessSizeArray[0] > maxWidth) {
        tryAgain.innerHTML = "You entered the first value too large (x-axis). Try again. Maximum value 13";
        tryAgain.setAttribute("style", "text-decoration: underline;");
        return;
    }


    for (let i = 0; i < y; i++) {
        for (let j = 0; j < x; j++) {
            let square = document.createElement("div");
            if (flag) {
                square.className = "black";
            } else {
                square.className = "white";
            }
            answerTask4.appendChild(square);
            flag = !flag;
        }
        answerTask4.append(document.createElement("br"));

        if (x % 2 == 0) {
            flag = !flag;
        }
    }
}



// Task5
let linkInput = document.getElementById("link");
let answerTask5 = document.getElementById("answerTask5");


linkInput.addEventListener("focus", (event) => {
    answerTask5.innerHTML = "";
});


linkInput.addEventListener("blur", (event) => {
    const regex = [
        /[(http(s)?:\/\/)(www)](\w+(-)?\w+\.)+(\w+)((\/)?(\.)?\w+)+/,
        /(\d{3}\.){2}\d\.\d/
    ];

    let linksArray = event.target.value;
    linksArray = linksArray.split(",");
    linksArray = linksArray.map((link) => link.trim());
    linksArray.sort();

    linksArray = linksArray.map((link) => {
        if (link.match(regex[0])) {
            let a = document.createElement("a");
            let indexSubstring = link.indexOf("//");
            let resultLink = "";

            if (indexSubstring >= 0) {
                resultLink = document.createTextNode(link.slice(indexSubstring + 2));
            } else {
                resultLink = document.createTextNode(link);
            }
            if(link.indexOf("https://") === -1 && link.indexOf("http://") === -1){
                link = "https://" + link;
            }

            a.appendChild(resultLink);
            a.href = link;
            a.target = "_blank";
            a.append(document.createElement("br"));
            answerTask5.appendChild(a);
        }

        if (link.match(regex[1])) {
            let arrayLinkElem = link.split(".");
            let flag = true;

            for (let x of arrayLinkElem) {
                if (x > 255) {
                    flag = false;
                    break;
                }
            }

            if (flag) {
                let a = document.createElement("a");
                let resultLink = document.createTextNode(link);
                a.appendChild(resultLink);
                a.href = link;
                a.target = "_blank";
                a.append(document.createElement("br"));
                answerTask5.appendChild(a);
            }
        }
    });
});




// Task6
function checkRegexExpression() {
    let regexInput = document.getElementById("regex").value;
    let regexText = document.getElementById("regexText").value;
    let answerTask6 = document.getElementById("answerTask6");

    let regex = new RegExp(regexInput, "ig");

    answerTask6.innerHTML = regexText.replace(regex, "<mark>$&</mark>");
}