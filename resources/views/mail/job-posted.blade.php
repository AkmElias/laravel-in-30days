<h2>
    {{$job->title}}
</h2>
<p> 
    Congrats! Your job is now live on the job board.
</p>

<p>
    <a href="{{url('/jobs/'. $job->id)}}">Here is your job listing</a>
</p>