<?php

/**
 * @file
 *
 */

?>

<style>
  tr.blast-highlighted td {
    background: #F6FFEC;
  }
</style>

<p>In bioinformatics, BLAST (Basic Local Alignment Search Tool) is an algorithm
for comparing primary biological sequence information, such as the amino-acid
sequences of different proteins or the nucleotides of DNA sequences. A BLAST
search enables a researcher to compare a query sequence with a library or
database of sequences, and identify library sequences that resemble the query
sequence above a certain threshold. Different types of BLASTs are available
according to the query sequences. For example, following the discovery of a
previously unknown gene in the mouse, a scientist will typically perform a
BLAST search of the human genome to see if humans carry a similar gene;
BLAST will identify sequences in the human genome that resemble the mouse
gene based on similarity of sequence.</p>

<blockquote>Altschul,S.F., Gish,W., Miller,W., Myers,E.W. and Lipman,D.J. (1990) Basic
local alignment search tool. J. Mol. Biol., 215, 403–410.</blockquote>

<h2> BLAST Search </h2>
<p>
  Search for one or more of your sequences (using BLAST). First pick 
  a query type (nucleotide or protein). You will be able to set search 
  parameters on the next page. Choose the appropriate program based on the Query type and Target
  database type. Please click on the program name to view the search form.
<p>

<table>
  <tr>
    <th>Query Type</th>
    <th>Database Type</th>
    <th>BLAST Program</th>
  </tr>
  <tr class= "blast-highlighted">
    <td>Nucleotide</td>
    <td rowspan="2">Nucleotide</td>
    <td><?php print l('blastn', './blast/nucleotide/nucleotide');?>:
      Search a nucleotide database using a nucleotide query.</td>
  </tr>
  <tr class="blast-highlighted">
    <td>Protein</td>
    <td><?php print l('blastx', './blast/nucleotide/protein');?>:
      Search protein database using a translated nucleotide query.</td>
  </tr>
  <tr>
    <td  rowspan="2">Protein</td>
    <td>Nucleotide</td>
    <td><?php print l('tblastn', './blast/protein/nucleotide');?>:
      Search translated nucleotide database using a protein query.</td>
  </tr>
  <tr>
    <td>Protein</td>
    <td><?php print l('blastp', './blast/protein/protein');?>:
      Search protein database using a protein query.</td>
  </tr>
</table>

<!-- Recent Jobs -->
<?php

  // Gets the list of recent jobs filtered to the current blast program (ie: blastn).
  $recent_jobs = get_recent_blast_jobs(array('blastn','blastx'));
  if ($recent_jobs) {
  
    print '<h2>Recent Jobs</h2>';
    
    $table = array(
      'header' => array('Query Information', 'Search Target', 'Date Requested', ''),
      'rows' => array(),
      'attributes' => array('class' => array('tripal-blast', 'recent-jobs')),
      'sticky' => FALSE
    );
  
    foreach ($recent_jobs as $job) {

      // Define a row for the current job.
      $table['rows'][] = array(
        $job['query_info'],
        $job['target'],
        $job['date'],
        l('See Results', $job['job_output_url'])
      );
    }
    
    print theme('table', $table);
  }
?>