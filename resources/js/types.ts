export type User = {
    id: number;
    name: string;
    email: string;
    email_verified_at: string;
    created_at: string;
    updated_at: string;
};

export type Rating = {
    id: number;
    bewertung: number;
    created_at: string;
    updated_at: string;
    user_id: number;
    campingground_id: number;
};

export type Campingground = {
    id: number;
    name: string;
    plz: string;
    ort: string;
    straße: string;
    hausnummer: string;
    telefonnummer: string;
    oeffnungszeitenAnfang: string;
    oeffnungszeitenEnde: string;
    preis: string;
    anzahlFreierPlaetze: number;
    WC: 0 | 1;
    dusche: 0 | 1;
    spielplatz: 0 | 1;
    tiereErlaubt: 0 | 1;
    barrierefrei: 0 | 1;
    bademoeglichkeit: 0 | 1;
    kiosk: 0 | 1;
    WLAN: 0 | 1;
    strom: 0 | 1;
    waschmaschine: 0 | 1;
    bildURL: string;
    created_at: string;
    updated_at: string;
};

export type UserWithRatings = User & { ratings: Rating[] };
