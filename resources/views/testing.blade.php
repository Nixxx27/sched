<?php

// your code goes here

$json = '
    {"location_code":"NATIONAL","result":[{"contest":"VICE-PRESIDENT PHILIPPINES",
        "candidates":[{"name":"CAYETANO, ALAN PETER (IND)","vote_count":"5660101","party":"LIBERAL PARTY|IND"},
                        {"name":"ESCUDERO, CHIZ (IND)","vote_count":"4802259","party":"LIBERAL PARTY|IND"},
        {"name":"MARCOS, BONGBONG (IND)","vote_count":"13769527","party":"LIBERAL PARTY|IND"},
        {"name":"TRILLANES, ANTONIO IV (IND)","vote_count":"841140","party":"LIBERAL PARTY|IND"},
        {"name":"ROBREDO, LENI DAANG MATUWID (LP)","vote_count":"13981789","party":"LIBERAL PARTY|LP"},
        {"name":"HONASAN, GRINGO (UNA)","vote_count":"757883","party":"UNITED NATIONALIST ALLIANCE|UNA"}]}]
        ,"election_returns_processed":"90311/94276","total_voters_processed":"43591490/55735757","result_as_of":"05/12/2016 12:45:00","processed_by":"LOCAL"}';

$location_code = json_decode($json,TRUE);
echo $location_code = $location_code['processed_by'];
