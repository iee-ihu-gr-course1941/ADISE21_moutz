
# ADISE21_moutz


# Table of Contents

- [Εγκατάσταση](#εγκατάσταση)
  - [Απαιτήσεις](#απαιτήσεις)
  - [Οδηγίες Εγκατάστασης](#οδηγίες-εγκατάστασης)
- [Περιγραφή Παιχνιδιού](#περιγραφή-παιχνιδιού)
  - [Συντελεστές](#συντελεστές)
- [Περιγραφή API](#περιγραφή-api)
    - [Methods](#methods)
        

## Εγκατάσταση
### Απαιτήσεις

- Apache2
- Mysql Server
- php

### Οδηγίες Εγκατάστασης

- Κάντε clone το project σε κάποιον φάκελο <br/>
  `$ git clone https://github.com/iee-ihu-gr-course1941/ADISE21_moutz`

- Βεβαιωθείτε ότι ο φάκελος είναι προσβάσιμος από τον Apache Server. πιθανόν να χρειαστεί να καθορίσετε τις παρακάτω ρυθμίσεις.

- Θα πρέπει να δημιουργήσετε στην Mysql την βάση με όνομα 'adise2021' και να φορτώσετε σε αυτήν την βάση τα δεδομένα από το αρχείο adise2021.sql
## Περιγραφή Παιχνιδιού
Ο μουτζούρης παίζεται ως εξής: Ο στόχος του παιχνιδιού είναι να μείνεις χωρίς φύλλα στο χέρι. Αυτός που θα μείνει με ένα φύλλο είναι ο χαμένος. Κάθε παίχτης αφαιρεί από τα φύλλα που έχει στα χέρια του τα ζευγάρια, δηλαδή, 2 Άσσους 2 δυάρια 2 τριάρια κ.τ.λ. Τα υπόλοιπα τα κρατάμε στο χέρι σαν βεντάλια έτσι ώστε να μπορεί ο άλλος παίχτης να διαλέξει, χωρίς να τα βλέπει, ένα από αυτά. Ο πρώτος παίχτης τραβάει ένα φύλλο από αυτόν που κάθετε στα αριστερά του, αν κάνει ζευγάρι το νέο χαρτί με κάποια από τα δικά του τότε τα ρίχνει, αλλιώς τα κρατάει και συνεχίζει ο επομένως που είναι στα δεξιά του. Όποιος ζευγαρώσει όλα τα φύλλα του βγαίνει από το παιχνίδι. Όποιος μείνει τελευταίος με τον Ρήγα Μπαστούνι (τον Μουτζούρη) στο χέρι του είναι ο χαμένος, και οι υπόλοιποι παίχτες αποφασίζουν την ποινή του.

Οι κανόνες είναι οι εξής: Πριν ξεκινήσετε αφαιρείτε από την τράπουλα όλες τις φιγούρες και κρατάτε μόνο έναν Ρήγα (Χαρτιά : 41). Ανακατεύουμε καλά, μοιράζουμε όλη την τράπουλα στους παίχτες έτσι ώστε όλοι να έχουν των ίδιο αριθμό φύλλων (ή + - 1).

Η βάση μας κρατάει τους εξής πίνακες και στοιχεία:
-Το users που περιέχει τα στοιχεία των χρηστών που έχουν δημιουργήσει λογαριασμό στην βάση μας.
-Το cards που περιέχει τις κάρτες που υπάρχουν στη τράπουλα.
-Το room που περιέχει τα ονόματα τον δωματίων στα οποία μπορούν να μπούν οι παίχτες ώστε να παίξουν.
-Το activerooms που περιέχει τα ενεργά δωμάτια, δλδ αυτά που έχουν μπεί δύο παίχτες και έχει ξεκινήσει παιχνίδι.
-Το playercards που περιέχει την τράπουλα στην οποία κάθε κάρτα αντιστοιχεί στο id του παίχτη που την χρησιμοποιεί. Αυτό το table αλλάζει κατά την διάρκεια του παιχνιδιού.

Η εφαρμογή απαπτύχθηκε μέχρι το σημείο του να δημιουργείται ένας χρήστης και αφότου συνδεθεί με το username και το password που καταχώρησε να πατήσει σε ένα room και να περιμένει κάποιον άλλον να μπεί στο room για να ξεκινήσει το παιχνίδι και να παίξουν μεταξύ τους.

## Συντελεστές

Περιγράψτε τις αρμοδιότητες της ομάδας.

Μαυράκης Αντώνιος 185222: Jquery, Σχεδιασμός mysql

Κωσταντινίδης Βασίλειος 185207: PHP API

Βράκας Ηλίας 185367: Σχεδιασμός UI
## Περιγραφή API
# Methods

```
POST /joinroom/
```

Επιστρέφει "user was joined".

#### /startgame/

```
POST /startgame/
```

Κάνει insert 1 row στο activerooms το οποιο περιέχει το playerturn το roomid και το playerstatus
Επίσης ανακατέυει την τράπουλα και την προσθέτει στο playercards

#### /showdeck/

```
POST /showdeck/
```

Επιστρέφει την τράπουλα

#### /dropcards/

```
POST /dropcards/
```

Ελένχει άν είναι η σειρά του player και άν είναι ρίχνει τα ζευγάρια απο το playercards τις κάρτες με ίδιο id me ton player


#### /selectcard/

```
POST /selectcard/
```

Διαλέγει μια τυχαία κάρτα απο τον αντίπαλο και αλλάζει το userid της

#### /changeturn/

```
POST /changeturn/
```

πηγαίνει μέσα στο activerooms και αλλάζει την σειρά

#### /getwinner/

```
POST /getwinner/
```

Ελένχει ποίος έχει την τελευταία κάρτα και επιστρέφει το όνομα του άλλου

#### /leavelobby/

```
POST /leavelobby/
```

Βγάζει τον user απο το lobby

#### /login/

```
POST /login/
```

Αν ο user υπάρχει στο database του δημιουργεί ένα JWT.

#### /register/

```
POST /register/
```

Δημιουργεί έναν user στην βάση