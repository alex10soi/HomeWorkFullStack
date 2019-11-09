const ATM = {
    isAuth: false, 
    currentUser: {},
    // all cash available in ATM
    cash: 2000,
    // all available users
    users: [
        { id: "0000", pin: "000", debet: 0, type: "admin" }, // EXTENDED
        { id: "0025", pin: "123", debet: 675, type: "user1" },
        { id: "0026", pin: "124", debet: 1675, type: "user2" }
    ],
    ATMLogs: [],
    // authorization
    auth(id, pin) {
         if (!this.isAuth) {
            let index = this.users.findIndex(item => item.id === id && item.pin === pin);
            let userData = this.users[index];
            if (index >= 0) {
                this.isAuth = true;
                this.currentUser = userData;
                console.log("Hello " + userData.type + ". You have successfully logged in.");
                this.ATMLogs.push(userData.type + " logged in");
            } else {
                console.log("Wrong login or password. Try again.");
                this.ATMLogs.push("Someone with " + id + " number tried to log in.");
            }
        } else {
            console.log("Some user has already logged in. Try again later.");
            this.ATMLogs.push("User " + id + " number tried to log in");
        }
    },
    // check current debet
    check() {
         if (!this.isAuth) {
            console.log("You need to log in.");
            this.ATMLogs.push("Someone wanted access to information without registration.");
        } else {
            let index = this.users.findIndex(item => item.id === this.currentUser.id);
            let userData = this.users[index];
            console.log("Your debet is $" + userData.debet);
            this.ATMLogs.push("The " + userData.type + " checked the status of his account.");
        }
    },
    // get cash - available for user only
    getCash(amount) {
        if (!this.isAuth) {
            console.log("You need to log in.");
            this.ATMLogs.push("Someone wanted to withdraw money without registration");
        } else {
            let index = this.users.findIndex(item => item.id === this.currentUser.id);
            let userData = this.users[index];
            if(userData.type === "admin"){
                console.log("Sorry. But you can't do this.");
                this.ATMLogs.push("Admin tried to get the money. Forbidden function for admin.");
                return;
            }else if (amount <= this.cash && amount <= userData.debet) {
                userData.debet -= amount;
                this.cash -= amount;
                console.log("Take your money in the amount of $" + amount + ". Account balance is $ " + userData.debet);
                this.ATMLogs.push("The " + userData.type + " withdrew money from his account");
            } else if (amount > this.cash) {
                console.log("This is too much. Contact the bank branch.");
                this.ATMLogs.push("The " + userData.type + " requested too much.");
            } else if (amount > userData.debet) {
                console.log("You do not have enough money in your account.");
                this.ATMLogs.push("The " + userData.type + " tried to withdraw the amount of money more than he has in his account.");
            }
        }
    },
    // load cash - available for user only
    loadCash(amount) {
         if (!this.isAuth) {
            console.log("You need to log in.");
            this.ATMLogs.push("Someone wanted to fund the account.");
        } else {
            let index = this.users.findIndex(item => item.id === this.currentUser.id);
            let userData = this.users[index];
            if(userData.type === "admin"){
                console.log("You can't do it.");
                this.ATMLogs.push("Admin tried to fund your account");
            }else{
                this.cash += amount;
                userData.debet += amount;
                console.log("Your account balance is $ " + userData.debet);
                this.ATMLogs.push(userData.type + " replenished his account");
            }   
        }
    },
    // load cash to ATM - available for admin only - EXTENDED
    loadAtmCash(amount) {
         if (!this.isAuth) {
            console.log("You need to log in.");
            this.ATMLogs.push("Someone tried to replenish the cash balance of the ATM and was not logged in");
        } else {
            let index = this.users.findIndex(item => item.id === this.currentUser.id);
            let userData = this.users[index];
            if(userData.type !== "admin"){
                console.log("You can't do it.");
                this.ATMLogs.push( userData.type + " wanted to replenish the cash balance of the ATM ");
            }else{
                this.cash += amount;
                console.log("The balance of money at the ATM is $ " + this.cash);
                this.ATMLogs.push("ATM balance was replenished by admin");
            }   
        }
    },
    // get cash actions logs - available for admin only - EXTENDED
    getLogs() {
         if (!this.isAuth) {
            console.log("You need to log in.");
            this.ATMLogs.push("Someone wanted to print an action log and wasn't registered");
        } else {
            let index = this.users.findIndex(item => item.id === this.currentUser.id);
            let userData = this.users[index];
            if(userData.type !== "admin"){
                console.log("You can't do it.");
                this.ATMLogs.push( userData.type + " wanted to print an action log");
            }else{
                for(let log_item of this.ATMLogs){
                    console.log(log_item);
                }
                this.ATMLogs.push("admin printed information with action log");
            }   
        }  
    },
    // log out
    logout() {
         if(this.isAuth){
            let index = this.users.findIndex(item => item.id === this.currentUser.id);
            let userData = this.users[index];
            this.isAuth = false;
            console.log("Thank you for using our services.");
            this.ATMLogs.push("The " + userData.type + " has logged out.")
       }
    }
};
