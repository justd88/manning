# Calculate Single Manning

To calculate single manning:

Segment:
A range of time. 
like a worker shift

First Create The Rota and add worker shifts as segments<br/>
*Note: The unit for segments are defined by you. could be minutes, hours, minutes or seconds*
```
$rota = new Rota(
    monday: [new Segment(0, 22)],
    tuesday: [new Segment(0, 10), new Segment(10, 23)],
    wednesday: [],
    thursday: [new Segment(0, 12), new Segment(10, 27)],
    friday: [new Segment(0, 22)],
    saturday: [],
    sunday: []
);
```

To calculate the single manning our use the `App\Factory\SingleManningFactory` `create` method<br/>
*Note: The unit for singlemannings durations will be defined by the rota.*

```
$singleManningDto = $singleManningFactory->create($rota);
```

