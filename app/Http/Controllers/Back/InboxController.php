<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Inbox;

class InboxController extends Controller
{
    /**s
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $inboxes = Inbox::orderBy('created_at', 'DESC')->get();
        return view('back.inbox.index', compact('inboxes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Inbox  $inbox
     * @return \Illuminate\Http\Response
     */
    public function show(Inbox $inbox)
    {
        $inboxes = Inbox::findOrFail($inbox->id);
        $inboxes->status = 1;
        $inboxes->save();
        view()->share('inboxCenter', Inbox::where('status', 0)->orderBy('id', 'ASC')->get());
        return view('back.inbox.show', compact('inboxes'));
    }
    public function sendershow($id)
    {
        $inboxes = Inbox::findOrFail($id);
        return view('back.inbox.sendershow', compact('inboxes'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Inbox  $inbox
     * @return \Illuminate\Http\Response
     */
    public function edit(Inbox $inbox)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Inbox  $inbox
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Inbox $inbox)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Inbox  $inbox
     * @return \Illuminate\Http\Response
     */
    public function destroy(Inbox $inbox)
    {
        Inbox::findOrFail($inbox->id)->created_at = now();
        Inbox::findOrFail($inbox->id)->delete();
        toastr()->success('Mesaj başarılı bir şekilde silindi.');
        if (url()->previous() == route('admin.inbox.index')) {
            return redirect()->route('admin.inbox.index');
        } else {
            return redirect()->route('admin.inbox.sentedAll');
        }
    }
    public function replyMulti(Request $request)
    {
        $emails = "";
        $count = count($request['InboxId']);
        for ($i=0; $i < $count; $i++) {
            $person = Inbox::findOrFail($request['InboxId'][$i])->sEmail;
            $emails = $emails.$person;
            if ($count-1 != $i) {
                $emails = $emails.",";
            }
        }

        return view('back.inbox.write', compact('emails'));
    }
    public function trashMulti(Request $request)
    {
        if (url()->previous() == route('admin.inbox.trashed')) {
            foreach ($request->post()['InboxId'] as $id) {
                Inbox::onlyTrashed()->findOrFail($id)->forceDelete();
            }
            toastr()->success('Mesajlar başarılı bir şekilde silindi.');
            return redirect()->route('admin.inbox.trashed');
        } else {
            foreach ($request->post()['InboxId'] as $id) {
                Inbox::findOrFail($id)->delete();
            }
            toastr()->success('Mesajlar başarılı bir şekilde silindi.');
            if (url()->previous() == route('admin.inbox.sentedAll')) {
                return redirect()->route('admin.inbox.sentedAll');
            } else {
                return redirect()->route('admin.inbox.index');
            }
        }
    }
    public function refreshMulti(Request $request)
    {
        foreach ($request->post()['InboxId'] as $id) {
            $Inbox =Inbox::onlyTrashed()->findOrFail($id);
            Inbox::onlyTrashed()->findOrFail($id)->restore();
            $Inbox->created_at = now();
            $Inbox->save();
        }
        toastr()->success('Mesajlar başarılı bir şekilde geri yüklendi.');
        return redirect()->route('admin.inbox.trashed');
    }
    public function sentedAll()
    {
        $inboxes = Inbox::orderBy('created_at', 'desc')->get();
        return view('back.inbox.sentedAll', compact('inboxes'));
    }
    public function trashed()
    {
        $inboxes=Inbox::onlyTrashed()->orderBy('deleted_at', 'desc')->get();
        return view('back.inbox.trashed', compact('inboxes'));
    }
    public function reply($id)
    {
        $emails = Inbox::findOrFail($id)->sEmail;
        return view('back.inbox.write', compact('emails'));
    }
    public function write()
    {
        $emails="";
        return view('back.inbox.write', compact('emails'));
    }
    public function writePost(Request $request)
    {
        $emails = explode(",", $request->email);
        foreach ($emails as $email) {
            $inbox = new Inbox;
            $inbox->name = auth()->user()->name;
            $inbox->status = 1;
            $inbox->sEmail = auth()->user()->email;
            $inbox->rEmail =  $email;
            $inbox->topic =  $request->subject;
            $inbox->message =  $request->contect;
            $inbox->save();
        }
        toastr()->success('Mesaj başarılı bir şekilde geri göderildi');
        return redirect()->route('admin.inbox.sentedAll');
    }
    public function unreadMulti(Request $request)
    {
        foreach ($request->post()['InboxId'] as $id) {
            $inboxes = Inbox::findOrFail($id);
            $inboxes->status = 0;
            $inboxes->save();
        }
        view()->share('inboxCenter', Inbox::where('status', 0)->orderBy('id', 'ASC')->get());
        toastr()->success('Mesajlar başarılı bir şekilde okunmadı işaretlendi.');
        return redirect()->route('admin.inbox.index');
    }
    public function readedMulti(Request $request)
    {
        foreach ($request->post()['InboxId'] as $id) {
            $inboxes = Inbox::findOrFail($id);
            $inboxes->status = 1;
            $inboxes->save();
        }
        view()->share('inboxCenter', Inbox::where('status', 0)->orderBy('id', 'ASC')->get());
        toastr()->success('Mesajlar başarılı bir şekilde okunmadı işaretlendi.');
        return redirect()->route('admin.inbox.index');
    }
}
