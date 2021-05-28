## Installation

- clone it
- create db and import real_estate.sql
- fix .env

## Consideration

- l'app e' ancora in via di sviluppo, in questo momento non e' ancora possibile installarla da composer
- la parte CRM si trova su packages/Areaseb/Estate, che diventera' un pacchetto
- la parte website e' invece in /App e /resources
- Areaseb/Estate e' un riadattamento di Areaseb/Core
- si puo' dividere in 4 chunks:
    1- Core
    2- Client: (Client, ClientType, Contact, Sector)
    3- Property: (Area, Contract, Feat, Poi, Property, Tag, Type)
    4- Client-Property relations (Booking, ClientLog, Offer, Ownership, OwnershipData, Request, View)
- le relazioni Client-Property hanno questa logica:
    client--hasMany--contacts
    client->primary -> client->contacts()->where('primary', true)->first()
    alcune relazione sono Model-Client altre Model-Contact
